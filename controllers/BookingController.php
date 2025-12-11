<?php
class BookingController
{
    public $bookingQuery;
    function __construct()
    {
        $this->bookingQuery = new BookingQuery();
        $this->GuideQuery = new GuideQuery();
        $this->HotelQuery = new HotelQuery();
        $this->ToursQuery = new ToursQuery();
        $this->VehiclesQuery = new VehiclesQuery();
        $this->CustomerQuery = new CustomerQuery();
        $this->TourScheduleQuery = new TourScheduleQuery();
    }

    public function listBooking()
    {
        $status = $_GET['status'] ?? '';
        $from = $_GET['from'] ?? '';
        $to = $_GET['to'] ?? '';
        $bookings = $this->bookingQuery->getBookingsByAdvancedFilter($status, $from, $to);
        require './views/Booking/listBooking.php';
    }
    public function searchBooking()
    {
        $keyword = $_GET['keyword'] ?? '';
        $bookings = $this->bookingQuery->searchBooking($keyword);
        require './views/Booking/listBooking.php';
    }

    public function deleteCustomer($bc_id, $booking_id)
    {
        $customers = $this->bookingQuery->getBookingCustomers($booking_id);
        $total_customers = count($customers);
        if ($total_customers <= 5) {
            $_SESSION['error'] = "Không thể xóa! Booking cần phải có ít nhất 5 khách.";
            header("Location: ?action=admin-detailBooking&id=" . $booking_id);
            exit;
        }
        $info = $this->bookingQuery->getCustomerIdByBCId($bc_id);
        $customer_id = $info['customer_id'];
        $this->bookingQuery->deleteCustomerFromBooking($bc_id);
        $this->bookingQuery->deleteAttendanceByCustomer($booking_id, $customer_id);
        $_SESSION['message'] = "Xóa khách thành công!";
        header("Location: ?action=admin-detailBooking&id=" . $booking_id);
        exit;
    }

    public function detailBooking($id)
    {
        $booking = $this->bookingQuery->getBooking($id);
        $guide = $this->bookingQuery->getGuideByBooking($id);
        $customers = $this->bookingQuery->getBookingCustomers($id);
        $attendance = $this->bookingQuery->getAttendance($id);
        $customers_all = $this->CustomerQuery->getAllCustomers();
        $segmentsRaw = $this->bookingQuery->getSegmentCustomersByBooking($id);
        $tour = $this->ToursQuery->findTour($booking['tour_id']);
        $hotel = $this->HotelQuery->findHotel($booking['hotel_id']);
        $vehicle = $this->VehiclesQuery->findVehicles($booking['vehicle_id']);
        $tour_schedules = $this->ToursQuery->getTourSchedule($booking['tour_id']);

        $segments_grouped = [];
        foreach ($segmentsRaw as $s) {
            $sid = $s['tour_schedule_id'];
            if (!isset($segments_grouped[$sid])) {
                $segments_grouped[$sid] = [
                    "day_number" => $s['day_number'],
                    "title" => $s['schedule_title'],
                    "vehicle_id" => $s['vehicle_id'],
                    "vehicle" => $s['vehicle_name'],
                    "price_per_day" => $s['price_per_day'],
                    "using" => [],
                    "excluded" => []
                ];
            }
            if ($s['segment_price_per_customer'] > 0) {
                $segments_grouped[$sid]["using"][] = $s;
            } else {
                $segments_grouped[$sid]["excluded"][] = $s;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_add_customer'])) {
            $new_customer = $_POST['add_customer_id'] ?? '';
            if (!$new_customer) {
                $_SESSION['error'] = "Vui lòng chọn khách cần thêm.";
                header("Location: ?action=admin-detailBooking&id=" . $id);
                exit;
            }
            // Kiểm tra trùng trong booking
            foreach ($customers as $c) {
                if ($c['customer_id'] == $new_customer) {
                    $_SESSION['error'] = "Khách này đã tồn tại trong booking.";
                    header("Location: ?action=admin-detailBooking&id=" . $id);
                    exit;
                }
            }
            // Kiểm tra trùng lịch
            if (
                $this->bookingQuery->checkCustomerConflict(
                    $new_customer,
                    $booking['start_date'],
                    $booking['end_date'],
                    $id
                )
            ) {
                $_SESSION['error'] = "Khách đang tham gia một tour khác trùng lịch.";
                header("Location: ?action=admin-detailBooking&id=" . $id);
                exit;
            }
            $customerInfo = $this->CustomerQuery->findCustomer($new_customer);

            $priceBase = $this->calculatePrice(
                $customerInfo,
                $tour,
                $hotel,
                $booking['start_date'],
                $booking['end_date']
            );

            $extra = 0;
            foreach ($segments_grouped as $sid => $seg) {
                if (!$seg['vehicle_id'])
                    continue;

                $vehicle_id = $seg['vehicle_id'];
                $price_per_day = (float) $seg['price_per_day'];

                // khách hiện đang dùng xe
                $using_ids = array_map(fn($u) => $u['customer_id'], $seg['using']);

                // khách không dùng xe
                $excluded_ids = array_map(fn($e) => $e['customer_id'], $seg['excluded']);

                // nhóm khách dùng xe thực sự
                $real_using = array_diff($using_ids, $excluded_ids);

                // thêm khách mới vào nhóm dùng xe
                $real_using[] = $new_customer;

                $count = count($real_using);
                $price_per_customer = ($count > 0) ? $price_per_day / $count : 0;

                // cộng vào tổng giá
                $extra += $price_per_customer;

                // LƯU VÀO booking_segment_customers
                $this->bookingQuery->addSegmentCustomer(
                    $id,
                    $sid,
                    $new_customer,
                    $vehicle_id,
                    $price_per_customer
                );
            }

            $final_price = $priceBase + $extra;
            $this->bookingQuery->addBookingCustomers($id, $new_customer, 0, $final_price);
            $days = isset($tour['days']) ? (int) $tour['days'] : 1;
            $this->bookingQuery->addAttendanceForBooking($id, $new_customer, $days);
            $_SESSION['message'] = "Thêm khách thành công!";
            header("Location: ?action=admin-detailBooking&id=" . $id);
            exit;
        }
        require './views/Booking/DetailBooking.php';
    }


    private function calculatePrice($customer, $tour, $hotel, $start_date, $end_date)
    {
        $role_price = match ($customer['role']) {
            'adult' => $tour['price_adult'],
            'child' => $tour['price_child'],
            default => 0
        };

        $nights = (strtotime($end_date) - strtotime($start_date)) / 86400;
        $hotel_cost = $hotel['price_per_night'] * $nights;
        return $role_price + $hotel_cost;
    }


    public function createBooking()
    {
        $guides = $this->GuideQuery->getAllGuides();
        $hotels = $this->HotelQuery->getAllHotel();
        $tours = $this->ToursQuery->getAllTours();
        $vehicles = $this->VehiclesQuery->getAllVehicles();
        $customers = $this->CustomerQuery->getAllCustomers();

        // Tìm kiếm khách
        $search = $_POST['search_customer'] ?? '';
        $blocked_customers = [];

        if ($search !== '') {
            $search = strtolower($search);
            $filtered = [];
            foreach ($customers as $c) {
                if (
                    str_contains(strtolower($c['full_name']), $search) ||
                    str_contains(strtolower($c['phone']), $search)
                ) {
                    $filtered[] = $c;
                }
            }

            if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                foreach ($filtered as $c) {
                    if (
                        $this->bookingQuery->checkCustomerConflict(
                            $c['customer_id'],
                            $_POST['start_date'],
                            $_POST['end_date']
                        )
                    ) {
                        $blocked_customers[] = $c['customer_id'];
                    }
                }
            }
            $customers = $filtered;
        } else {
            if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                foreach ($customers as $c) {
                    if (
                        $this->bookingQuery->checkCustomerConflict(
                            $c['customer_id'],
                            $_POST['start_date'],
                            $_POST['end_date']
                        )
                    ) {
                        $blocked_customers[] = $c['customer_id'];
                    }
                }
            }
        }

        // STEP hiện tại
        $current_step = $_POST['current_step'] ?? 1;
        $current_step = (int) $current_step;

        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Quay lại step trước
            if (!empty($_POST['prev_step'])) {
                $current_step = (int) $_POST['prev_step'];
            }

            // ---------------- STEP 1 ----------------
            if ($current_step == 1 && isset($_POST['next_1'])) {

                $tour_id = $_POST['tour_id'] ?? '';
                $guide_id = $_POST['guide_id'] ?? '';
                $start_date = $_POST['start_date'] ?? '';

                if (!$tour_id || !$guide_id || !$start_date) {
                    $err['empty'] = "Vui lòng chọn Tour, HDV và ngày đi.";
                }

                if (!$err) {
                    $tour = $this->ToursQuery->findTour($tour_id);
                    $days = isset($tour['days']) ? (int) $tour['days'] : 1;
                    $end_date = date('Y-m-d', strtotime($start_date . " +$days days"));

                    // Check HDV trùng lịch
                    if ($this->bookingQuery->checkGuideConflict($guide_id, $start_date, $end_date)) {
                        $err['guide'] = "HDV đã có tour trùng lịch.";
                    }
                }

                if (!$err) {
                    $_POST['end_date'] = $end_date;
                    // tính lại blocked
                    $blocked_customers = [];
                    foreach ($customers as $c) {
                        if (
                            $this->bookingQuery->checkCustomerConflict(
                                $c['customer_id'],
                                $start_date,
                                $end_date
                            )
                        ) {
                            $blocked_customers[] = $c['customer_id'];
                        }
                    }

                    $current_step = 2;
                }
            }

            // ---------------- STEP 2 ----------------
            if ($current_step == 2 && isset($_POST['next_2'])) {
                $customers_arr = $_POST['customers'] ?? [];
                if (count($customers_arr) < 5) {
                    $err['customers'] = "Cần chọn ít nhất 5 khách.";
                }
                if (!$err) {
                    $current_step = 3;
                }
            }

            // ---------------- STEP 3: LƯU BOOKING ----------------
            if ($current_step == 3 && isset($_POST['final_submit'])) {

                $tour_id = $_POST['tour_id'] ?? '';
                $guide_id = $_POST['guide_id'] ?? '';
                $hotel_id = $_POST['hotel_id'] ?? '';
                $start_date = $_POST['start_date'] ?? '';
                $end_date = $_POST['end_date'] ?? '';
                $customers_arr = $_POST['customers'] ?? [];
                $main = $_POST['main_customer'] ?? '';

                // Dữ liệu xe
                $segment_vehicle = $_POST['segment_vehicle'] ?? [];
                $segment_exclude = $_POST['segment_exclude'] ?? [];

                if (!$tour_id || !$guide_id || !$hotel_id) {
                    $err['empty'] = "Vui lòng chọn đầy đủ thông tin.";
                }
                if (count($customers_arr) < 5) {
                    $err['customers'] = "Cần chọn ít nhất 5 khách.";
                }
                if ($main && !in_array($main, $customers_arr)) {
                    $err['main'] = "Khách đại diện không hợp lệ.";
                }

                if (!$err) {

                    // =========== TẠO BOOKING ===========
                    $this->bookingQuery->tour_id = $tour_id;
                    $this->bookingQuery->guide_id = $guide_id;
                    $this->bookingQuery->hotel_id = $hotel_id;
                    $this->bookingQuery->vehicle_id = null;
                    $this->bookingQuery->start_date = $start_date;
                    $this->bookingQuery->end_date = $end_date;
                    $this->bookingQuery->status = $this->bookingQuery->autoStatus($start_date, $end_date);
                    $this->bookingQuery->report = '';
                    $this->bookingQuery->created_at = date('Y-m-d H:i:s');

                    $booking_id = $this->bookingQuery->createBooking();

                    $tour = $this->ToursQuery->findTour($tour_id);
                    $hotel = $this->HotelQuery->findHotel($hotel_id);
                    $days = isset($tour['days']) ? (int) $tour['days'] : 1;
                    // ======= KHỞI TẠO MẢNG TỔNG GIÁ XE =======
                    $extraPrice = [];
                    $days = isset($tour['days']) ? (int) $tour['days'] : 1;
                    foreach ($customers_arr as $cid) {
                        $extraPrice[$cid] = 0;
                    }

                    // ======= DUYỆT TỪNG CHẶNG XE =======
                    foreach ($segment_vehicle as $schedule_id => $vehicle_id) {

                        $vehicle_id = (int) $vehicle_id;
                        if ($vehicle_id <= 0)
                            continue;

                        $vehicle = $this->VehiclesQuery->findVehicles($vehicle_id);
                        if (!$vehicle)
                            continue;

                        $segment_total = (float) $vehicle['price_per_day'];

                        $excluded = $segment_exclude[$schedule_id] ?? [];
                        if (!is_array($excluded))
                            $excluded = [];

                        // khách đi xe = tổng - khách không đi
                        $using_ids = array_diff($customers_arr, $excluded);
                        $count_using = count($using_ids);

                        $price_per_customer = $count_using > 0
                            ? $segment_total / $count_using
                            : 0;

                        // LƯU TỪNG KHÁCH CHO CHẶNG NÀY
                        foreach ($customers_arr as $cid) {

                            $is_using = in_array($cid, $using_ids);
                            $price = $is_using ? $price_per_customer : 0;

                            // Lưu vào booking_segment_customers
                            $this->bookingQuery->addSegmentCustomer(
                                $booking_id,
                                $schedule_id,
                                $cid,
                                $vehicle_id,
                                $price
                            );

                            $extraPrice[$cid] += $price;
                        }
                    }

                    // ========= Lưu khách =========
                    foreach ($customers_arr as $cid) {
                        $customer = $this->CustomerQuery->findCustomer($cid);
                        $base = $this->calculatePrice(
                            $customer,
                            $tour,
                            $hotel,
                            $start_date,
                            $end_date
                        );

                        $final_price = $base + $extraPrice[$cid];
                        $is_main = ($cid == $main) ? 1 : 0;
                        $this->bookingQuery->addBookingCustomers(
                            $booking_id,
                            $cid,
                            $is_main,
                            $final_price
                        );
                        // Điểm danh
                        $this->bookingQuery->addAttendanceForBooking($booking_id, $cid, $days);
                    }

                    // Gán guide_tours
                    $this->bookingQuery->addGuideTour($guide_id, $booking_id, $tour_id);

                    echo "<script>alert('Tạo booking thành công'); location.href='?action=admin-listBooking';</script>";
                    exit;
                }
            }
        }

        require './views/Booking/CreateBooking.php';
    }

    public function updateBooking($id)
    {
        $guides = $this->GuideQuery->getAllGuides();
        $hotels = $this->HotelQuery->getAllHotel();
        $tours = $this->ToursQuery->getAllTours();
        $vehicles = $this->VehiclesQuery->getAllVehicles();
        $customers = $this->CustomerQuery->getAllCustomers();
        $booking = $this->bookingQuery->getBooking($id);
        $oldCustomers = $this->bookingQuery->getBookingCustomers($id);
        $selected_old = array_column($oldCustomers, 'customer_id');
        $segments = $this->bookingQuery->getSegmentCustomersByBooking($id);

        $segment_grouped = [];
        foreach ($segments as $s) {
            $sid = $s['tour_schedule_id'];

            if (!isset($segment_grouped[$sid])) {
                $segment_grouped[$sid] = [
                    "vehicle_id" => $s['vehicle_id'],
                    "price_per_day" => $s['price_per_day'],
                    "using" => [],
                    "excluded" => []
                ];
            }

            if ($s['segment_price_per_customer'] > 0) {
                $segment_grouped[$sid]["using"][] = $s['customer_id'];
            } else {
                $segment_grouped[$sid]["excluded"][] = $s['customer_id'];
            }
        }


        // Khách đại diện cũ
        $main_old = "";
        foreach ($oldCustomers as $c) {
            if ($c['is_main'] == 1) {
                $main_old = $c['customer_id'];
                break;
            }
        }

        // Schedules theo tour hiện tại (hoặc tour POST)
        $tour_id_for_schedule = $_POST['tour_id'] ?? $booking['tour_id'];
        $schedules = $this->ToursQuery->getTourSchedules($tour_id_for_schedule);

        // Tìm kiếm khách
        $search = $_POST['search_customer'] ?? '';
        $blocked_customers = [];

        if ($search !== '') {
            $search = strtolower($search);
            $filtered = [];
            foreach ($customers as $c) {
                if (
                    str_contains(strtolower($c['full_name']), $search) ||
                    str_contains(strtolower($c['phone']), $search)
                ) {
                    $filtered[] = $c;
                }
            }
            // Check trùng lịch
            if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                foreach ($filtered as $c) {
                    if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date, $id)) {
                        $blocked_customers[] = $c['customer_id'];
                    }
                }
            }
            $customers = $filtered;
        } else {
            $start_date = $_POST['start_date'] ?? $booking['start_date'];
            $end_date = $_POST['end_date'] ?? $booking['end_date'];
            if ($start_date && $end_date) {
                foreach ($customers as $c) {
                    if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date, $id)) {
                        $blocked_customers[] = $c['customer_id'];
                    }
                }
            }
        }

        // STEP hiện tại
        $current_step = isset($_POST['current_step']) ? (int) $_POST['current_step'] : 1;
        $err = [];
        $customers_arr = $_POST['customers'] ?? $selected_old;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Quay lại step
            if (!empty($_POST['prev_step'])) {
                $current_step = (int) $_POST['prev_step'];
                // Khi quay về step 2 cần tính lại blocked
                if ($current_step == 2 && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                    $start = $_POST['start_date'];
                    $end = $_POST['end_date'];
                    $blocked_customers = [];
                    foreach ($customers as $c) {
                        if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start, $end, $id)) {
                            $blocked_customers[] = $c['customer_id'];
                        }
                    }
                }

            } else {

                // ============ STEP 1: Tour & HDV =============
                if ($current_step == 1 && isset($_POST['next_1'])) {
                    $tour_id = $_POST['tour_id'] ?? '';
                    $guide_id = $_POST['guide_id'] ?? '';
                    $start_date = $_POST['start_date'] ?? '';

                    if (!$tour_id || !$guide_id || !$start_date) {
                        $err['empty'] = "Vui lòng chọn Tour, HDV và ngày đi.";
                    }

                    if (!$err) {
                        $tour = $this->ToursQuery->findTour($tour_id);
                        if (!$tour) {
                            $err['tour'] = "Tour không tồn tại.";
                        } else {
                            $days = max(1, (int) $tour['days']);
                            // end_date = start + days ngày
                            $end_date = date('Y-m-d', strtotime($start_date . " +{$days} days"));

                            // Check trùng lịch HDV, bỏ qua booking hiện tại
                            if ($this->bookingQuery->checkGuideConflict($guide_id, $start_date, $end_date, $id)) {
                                $err['guide'] = "HDV đã có tour trùng lịch.";
                            }
                        }
                    }
                    if (!$err) {
                        $_POST['end_date'] = $end_date;
                        // Tính lại khách bị khóa trong khoảng mới
                        $blocked_customers = [];
                        foreach ($customers as $c) {
                            if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date, $id)) {
                                $blocked_customers[] = $c['customer_id'];
                            }
                        }
                        // Cập nhật tour để load schedules đúng
                        $tour_id_for_schedule = $tour_id;
                        $schedules = $this->ToursQuery->getTourSchedules($tour_id_for_schedule);

                        $current_step = 2;
                    }
                }

                // ============ STEP 2: Chọn khách =============
                if ($current_step == 2 && isset($_POST['next_2'])) {
                    $customers_arr = $_POST['customers'] ?? [];

                    if (count($customers_arr) < 5) {
                        $err['customers'] = "Cần chọn ít nhất 5 khách.";
                    }

                    if (!$err) {
                        $current_step = 3;
                    }
                }
                // ============ STEP 3: Lưu cập nhật ===========
                if ($current_step == 3 && isset($_POST['final_submit'])) {
                    $tour_id = $_POST['tour_id'] ?? "";
                    $guide_id = $_POST['guide_id'] ?? "";
                    $hotel_id = $_POST['hotel_id'] ?? "";
                    $start_date = $_POST['start_date'] ?? "";
                    $end_date = $_POST['end_date'] ?? "";
                    $customers_arr = $_POST['customers'] ?? [];
                    $main = $_POST['main_customer'] ?? "";
                    $status_req = $_POST['status'] ?? $booking['status'];
                    $status = ($status_req === 'da_huy') ? 'da_huy' : $booking['status'];

                    // Dữ liệu xe theo lịch trình
                    $segment_vehicle = $_POST['segment_vehicle'] ?? [];
                    $segment_exclude = $_POST['segment_exclude'] ?? [];

                    if (!$tour_id || !$guide_id || !$hotel_id) {
                        $err['empty'] = "Vui lòng nhập đầy đủ thông tin (Tour / HDV / Khách sạn).";
                    }

                    if (count($customers_arr) < 5) {
                        $err['customers'] = "Cần ít nhất 5 khách.";
                    }

                    if ($main && !in_array($main, $customers_arr)) {
                        $err['main'] = "Khách đại diện phải nằm trong danh sách khách.";
                    }

                    if (!$err) {
                        $this->bookingQuery->updateBooking(
                            $id,
                            $tour_id,
                            $guide_id,
                            $hotel_id,
                            $status,
                            $start_date,
                            $end_date
                        );

                        // Lấy tour & hotel để tính giá
                        $tour = $this->ToursQuery->findTour($tour_id);
                        $hotel = $this->HotelQuery->findHotel($hotel_id);

                        // Xóa khách + điểm danh + segment cũ
                        $this->bookingQuery->deleteBookingCustomersOnly($id);
                        $this->bookingQuery->deleteAttendanceOnly($id);
                        $this->bookingQuery->deleteSegmentCustomersByBooking($id);

                        // Extra tiền xe theo từng khách
                        $extraPrice = [];
                        foreach ($customers_arr as $cid) {
                            $extraPrice[$cid] = 0;
                        }

                        // ===== GÁN XE THEO LỊCH TRÌNH =====
                        foreach ($segment_vehicle as $schedule_id => $vehicle_id) {
                            $vehicle_id = (int) $vehicle_id;
                            if ($vehicle_id <= 0)
                                continue;

                            $vehicle = $this->VehiclesQuery->findVehicles($vehicle_id);
                            if (!$vehicle)
                                continue;

                            $segment_total = (float) $vehicle['price_per_day'];

                            $excluded = $segment_exclude[$schedule_id] ?? [];
                            if (!is_array($excluded))
                                $excluded = [];

                            // khách dùng xe = khách được chọn - khách không đi
                            $using_ids = array_diff($customers_arr, $excluded);
                            $count_using = count($using_ids);

                            $price_per_customer = ($count_using > 0)
                                ? $segment_total / $count_using
                                : 0;

                            foreach ($customers_arr as $cid) {
                                $is_using = in_array($cid, $using_ids);
                                $price = $is_using ? $price_per_customer : 0;

                                // Lưu vào bảng booking_segment_customers
                                $this->bookingQuery->addSegmentCustomer(
                                    $id,
                                    $schedule_id,
                                    $cid,
                                    $vehicle_id,
                                    $price
                                );

                                if ($price > 0) {
                                    $extraPrice[$cid] += $price;
                                }
                            }
                        }

                        // ===== LƯU LẠI DANH SÁCH KHÁCH =====
                        foreach ($customers_arr as $cid) {
                            $customer = $this->CustomerQuery->findCustomer($cid);

                            // giá tour + hotel
                            $base = $this->calculatePrice($customer, $tour, $hotel, $start_date, $end_date);

                            // tổng = base + extra xe
                            $final_price = $base + ($extraPrice[$cid] ?? 0);

                            $is_main = ($cid == $main) ? 1 : 0;

                            $this->bookingQuery->addBookingCustomers($id, $cid, $is_main, $final_price);
                            $days = isset($tour['days']) ? (int) $tour['days'] : 1;
                            $this->bookingQuery->addAttendanceForBooking($id, $cid, $days);
                        }

                        // ===== GUIDE_TOUR =====
                        if ($status === 'da_huy') {
                        } else {
                            $this->bookingQuery->syncGuideTour($guide_id, $id, $tour_id);
                        }
                        echo "<script>alert('Cập nhật booking thành công!'); window.location.href='?action=admin-listBooking';</script>";
                        exit;
                    }
                }
            }
        }

        $selected_customers = $customers_arr ?: $selected_old;
        require './views/Booking/updateBooking.php';
    }


    public function deleteBooking($id)
    {
        if ($this->bookingQuery->deleteBooking($id)) {
            echo "<script>alert('Xóa booking thành công!'); window.location.href='?action=admin-listBooking';</script>";
        } else {
            echo "<script>alert('Không thể xóa booking này!'); window.location.href='?action=admin-listBooking';</script>";
        }
        exit;
    }
}
?>