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
        $filter = $_GET['filter'] ?? '';
        $bookings = $this->bookingQuery->getBookingsByFilter($filter);
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
        $info = $this->bookingQuery->getCustomerIdByBCId($bc_id);
        $customer_id = $info['customer_id'];
        $this->bookingQuery->deleteCustomerFromBooking($bc_id);
        $this->bookingQuery->deleteAttendanceByCustomer($booking_id, $customer_id);
        $_SESSION['message'] = "Xóa khách thành công!";
        header("Location: ?action=admin-detailBooking&id=" . $booking_id);
        exit;
    }

    public function detailBooking($id){
        $booking = $this->bookingQuery->getBooking($id);
        $guide = $this->bookingQuery->getGuideByBooking($id);
        $customers = $this->bookingQuery->getBookingCustomers($id);
        $attendance = $this->bookingQuery->getAttendance($id);
        $customers_all = $this->CustomerQuery->getAllCustomers();
        $tour = $this->ToursQuery->findTour($booking['tour_id']);
        $hotel = $this->HotelQuery->findHotel($booking['hotel_id']);
        $vehicle = $this->VehiclesQuery->findVehicles($booking['vehicle_id']);
        $tour_schedules = $this->ToursQuery->getTourSchedule($booking['tour_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_add_customer'])) {
            $new_customer = $_POST['add_customer_id'];
            if (empty($new_customer)) {
                $_SESSION['error'] = "Vui lòng chọn khách cần thêm.";
                header("Location: ?action=admin-detailBooking&id=" . $id);
                exit;
            }
            foreach ($customers as $c) {
                if ($c['customer_id'] == $new_customer) {
                    $_SESSION['error'] = "Khách này đã có trong booking!";
                    header("Location: ?action=admin-detailBooking&id=" . $id);
                    exit;
                }
            }
            if ($this->bookingQuery->checkCustomerConflict($new_customer, $booking['start_date'], $booking['end_date'])) {
                $_SESSION['error'] = "Khách đang tham gia một tour khác trùng lịch!";
                header("Location: ?action=admin-detailBooking&id=" . $id);
                exit;
            }
            $total_customers = count($customers) + 1;

            $customerInfo = $this->CustomerQuery->findCustomer($new_customer);

            $price = $this->calculatePrice(
                $customerInfo,
                $tour,
                $hotel,
                $vehicle,
                $booking['start_date'],
                $booking['end_date'],
                $total_customers
            );

            $this->bookingQuery->addBookingCustomers($id, $new_customer, 0, $price);
            $this->bookingQuery->addAttendance($id, $new_customer);

            $_SESSION['message'] = "Thêm khách thành công!";
            header("Location: ?action=admin-detailBooking&id=" . $id);
            exit;
        }
        require './views/Booking/DetailBooking.php';
    }

    private function calculatePrice($customer, $tour, $hotel, $vehicle, $start_date, $end_date, $total_customers)
    {
        $role_price = match ($customer['role']) {
            'adult' => $tour['price_adult'],
            'child' => $tour['price_child'],
            'vip' => $tour['price_vip'],
            default => 0
        };
        $nights = (strtotime($end_date) - strtotime($start_date)) / 86400;
        $hotel_cost = $hotel['price_per_night'] * $nights;
        $vehicle_cost = ($vehicle['price_per_day'] * $nights) / max(1, $total_customers);
        return $role_price + $hotel_cost + $vehicle_cost;
    }

    public function createBooking(){
        $guides = $this->GuideQuery->getAllGuides();
        $hotels = $this->HotelQuery->getAllHotel();
        $tours = $this->ToursQuery->getAllTours();
        $vehicles = $this->VehiclesQuery->getAllVehicles();
        $customers = $this->CustomerQuery->getAllCustomers();
        $search = $_POST['search_customer'] ?? '';
        $blocked_customers = [];
        if ($search !== '') {
            $search = strtolower($search);
            $filtered = [];
            foreach ($customers as $c) {
                $name = strtolower($c['full_name']);
                $phone = strtolower($c['phone']);
                if (strpos($name, $search) !== false || strpos($phone, $search) !== false) {
                    $filtered[] = $c;
                }
            }
            if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                foreach ($filtered as $c) {
                    if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date)) {
                        $blocked_customers[] = $c['customer_id'];
                    }
                }
            }
            $customers = $filtered;
        } else {
            $start_date = $_POST['start_date'] ?? '';
            $end_date   = $_POST['end_date'] ?? '';
            if ($start_date && $end_date) {
                foreach ($customers as $c) {
                    if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date)) {
                        $blocked_customers[] = $c['customer_id'];
                    }
                }
            }
        }


        // Step hiện tại
        $current_step = isset($_POST['current_step']) ? (int) $_POST['current_step'] : 1;

        $err = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // ====== Quay lại step trước ======
            if (!empty($_POST['prev_step'])) {
                $current_step = (int) $_POST['prev_step'];
                if ($current_step == 2 && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];
                    foreach ($customers as $c) {
                        if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date)) {
                            $blocked_customers[] = $c['customer_id'];
                        }
                    }
                }
            } else {
                // STEP 1 → chọn tour, HDV, ngày đi
                if ($current_step == 1 && isset($_POST['next_1'])) {
                    $tour_id = $_POST['tour_id'] ?? '';
                    $guide_id = $_POST['guide_id'] ?? '';
                    $start_date = $_POST['start_date'] ?? '';

                    if (!$tour_id || !$guide_id || !$start_date) {
                        $err['empty'] = "Vui lòng chọn Tour, HDV và ngày đi.";
                    }

                    // Lấy thông tin tour để biết số ngày
                    if (!$err) {
                        $tour = $this->ToursQuery->findTour($tour_id);
                        if (!$tour) {
                            $err['tour'] = "Tour không tồn tại.";
                        } else {
                            $days = isset($tour['days']) ? (int) $tour['days'] : 1;
                            if ($days < 1)
                                $days = 1;

                            // Auto tính ngày về: start + days
                            $end_date = date('Y-m-d', strtotime($start_date . " +{$days} days"));

                            // Check HDV trùng lịch
                            if ($this->bookingQuery->checkGuideConflict($guide_id, $start_date, $end_date)) {
                                $err['guide'] = "HDV đã có tour trùng lịch.";
                            }
                        }
                    }

                    // Nếu OK → chuyển STEP 2 + tính danh sách khách bị khóa
                    if (!$err) {
                        // Tính khách trùng lịch
                        $blocked_customers = [];
                        foreach ($customers as $c) {
                            if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date)) {
                                $blocked_customers[] = $c['customer_id'];
                            }
                        }

                        // Gắn end_date vào POST để chuyển sang step 2 & 3
                        $_POST['end_date'] = $end_date;

                        $current_step = 2;
                    }
                }

                // STEP 2 → chọn khách
                if ($current_step == 2 && isset($_POST['next_2'])) {
                    $customers_arr = $_POST['customers'] ?? [];
                    if (count($customers_arr) < 3) {
                        $err['customers'] = "Cần chọn ít nhất 3 khách.";
                    }
                    if (!$err) {
                        $current_step = 3;
                    }
                }

                // STEP 3 → chọn dịch vụ & lưu
                if ($current_step == 3 && isset($_POST['final_submit'])) {

                    $tour_id = $_POST['tour_id'] ?? '';
                    $guide_id = $_POST['guide_id'] ?? '';
                    $hotel_id = $_POST['hotel_id'] ?? '';
                    $vehicle_id = $_POST['vehicle_id'] ?? '';
                    $start_date = $_POST['start_date'] ?? '';
                    $end_date = $_POST['end_date'] ?? '';
                    $customers_arr = $_POST['customers'] ?? [];
                    $main = $_POST['main_customer'] ?? '';

                    if (!$tour_id || !$guide_id || !$hotel_id || !$vehicle_id || !$start_date || !$end_date) {
                        $err['empty'] = "Vui lòng chọn đầy đủ thông tin trước khi tạo booking.";
                    }

                    if (count($customers_arr) < 3) {
                        $err['customers'] = "Cần chọn ít nhất 3 khách.";
                    }

                    if ($main && !in_array($main, $customers_arr)) {
                        $err['main'] = "Khách đại diện phải nằm trong danh sách khách.";
                    }

                    if (!$err) {
                        // Gán thuộc tính cho model
                        $this->bookingQuery->tour_id = $tour_id;
                        $this->bookingQuery->guide_id = $guide_id;
                        $this->bookingQuery->hotel_id = $hotel_id;
                        $this->bookingQuery->vehicle_id = $vehicle_id;
                        $this->bookingQuery->start_date = $start_date;
                        $this->bookingQuery->end_date   = $end_date;
                        $this->bookingQuery->status = $this->bookingQuery->autoStatus($start_date, $end_date);
                        $this->bookingQuery->report     = '';
                        $this->bookingQuery->created_at = date('Y-m-d H:i:s');

                        // Tạo booking
                        $booking_id = $this->bookingQuery->createBooking();

                        $tour = $this->ToursQuery->findTour($tour_id);
                        $hotel = $this->HotelQuery->findHotel($hotel_id);
                        $vehicle = $this->VehiclesQuery->findVehicles($vehicle_id);
                        $total_customers = count($customers_arr);
                        foreach ($customers_arr as $cid) {
                            $customer = $this->CustomerQuery->findCustomer($cid);
                            $price = $this->calculatePrice(
                                $customer,
                                $tour,
                                $hotel,
                                $vehicle,
                                $start_date,
                                $end_date,
                                $total_customers
                            );
                            $is_main = ($cid == $main) ? 1 : 0;
                            $this->bookingQuery->addBookingCustomers($booking_id, $cid, $is_main, $price);
                            $this->bookingQuery->addAttendance($booking_id, $cid);
                        }

                        // Gắn HDV - tour
                        $this->bookingQuery->addGuideTour($guide_id, $booking_id, $tour_id);

                        echo "<script>alert('Tạo booking thành công'); location.href='?action=admin-listBooking';</script>";
                        exit;
                    }
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
        $search = $_POST['search_customer'] ?? '';
        $blocked_customers = [];
        if ($search !== '') {
            $search = strtolower($search);
            $filtered = [];
            foreach ($customers as $c) {
                $name = strtolower($c['full_name']);
                $phone = strtolower($c['phone']);
                if (strpos($name, $search) !== false || strpos($phone, $search) !== false) {
                    $filtered[] = $c;
                }
            }
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
            $start_date = $_POST['start_date'] ?? '';
            $end_date   = $_POST['end_date'] ?? '';
            if ($start_date && $end_date) {
                foreach ($customers as $c) {
                    if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date, $id)) {
                        $blocked_customers[] = $c['customer_id'];
                    }
                }
            }
        }

        // Lấy booking cũ
        $booking = $this->bookingQuery->getBooking($id);
        $oldCustomers = $this->bookingQuery->getBookingCustomers($id);
        $selected_old = array_column($oldCustomers, 'customer_id');

        // Lấy khách đại diện cũ
        $main_old = "";
        foreach ($oldCustomers as $c) {
            if ($c['is_main'] == 1)
                $main_old = $c['customer_id'];
        }

        // STEP
        $current_step = isset($_POST['current_step']) ? (int) $_POST['current_step'] : 1;

        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['prev_step'])) {

                $current_step = (int) $_POST['prev_step'];

                // Nếu quay lại STEP 2 => tính khách trùng lịch
                if ($current_step == 2 && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                    $start = $_POST['start_date'];
                    $end = $_POST['end_date'];

                    foreach ($customers as $c) {
                        if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start, $end, $id)) {
                            $blocked_customers[] = $c['customer_id'];
                        }
                    }
                }
            } else {
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
                            $end_date = date('Y-m-d', strtotime($start_date . " +{$days} days"));

                            // Check trùng lịch HDV (ngoại trừ booking hiện tại)
                            if ($this->bookingQuery->checkGuideConflict($guide_id, $start_date, $end_date, $id)) {
                                $err['guide'] = "HDV đã có tour trùng lịch.";
                            }
                        }
                    }

                    if (!$err) {
                        // Tính khách bị khóa
                        foreach ($customers as $c) {
                            if ($this->bookingQuery->checkCustomerConflict($c['customer_id'], $start_date, $end_date, $id)) {
                                $blocked_customers[] = $c['customer_id'];
                            }
                        }
                        $_POST['end_date'] = $end_date;
                        $current_step = 2;
                    }
                }

                if ($current_step == 2 && isset($_POST['next_2'])) {

                    $customers_arr = $_POST['customers'] ?? [];
                    $main = $_POST['main_customer'] ?? '';
                    if (count($customers_arr) < 3) {
                        $err['customers'] = "Cần chọn ít nhất 3 khách.";
                    }
                    if ($main && !in_array($main, $customers_arr)) {
                        $err['main'] = "Khách đại diện phải nằm trong danh sách khách.";
                    }
                    if (!$err) {
                        $current_step = 3;
                    }
                }

                if ($current_step == 3 && isset($_POST['final_submit'])) {

                    $tour_id = $_POST['tour_id'] ?? "";
                    $guide_id = $_POST['guide_id'] ?? "";
                    $hotel_id = $_POST['hotel_id'] ?? "";
                    $vehicle_id = $_POST['vehicle_id'] ?? "";
                    $start_date = $_POST['start_date'] ?? "";
                    $end_date = $_POST['end_date'] ?? "";
                    $customers_arr = $_POST['customers'] ?? [];
                    $main = $_POST['main_customer'] ?? "";
                    $status = $_POST['status'] ?? "sap_dien_ra";

                    if (!$tour_id || !$guide_id || !$hotel_id || !$vehicle_id) {
                        $err['empty'] = "Vui lòng nhập đầy đủ thông tin.";
                    }

                    if (count($customers_arr) < 3) {
                        $err['customers'] = "Cần ít nhất 3 khách.";
                    }

                    if ($main && !in_array($main, $customers_arr)) {
                        $err['main'] = "Khách đại diện không hợp lệ.";
                    }

                    if (!$err) {

                        $this->bookingQuery->updateBooking(
                            $id,
                            $tour_id,
                            $guide_id,
                            $hotel_id,
                            $vehicle_id,
                            $status,
                            $start_date,
                            $end_date
                        );

                        // Xóa khách & điểm danh cũ
                        $this->bookingQuery->deleteBookingCustomersOnly($id);
                        $this->bookingQuery->deleteAttendanceOnly($id);

                        $tour = $this->ToursQuery->findTour($tour_id);
                        $hotel = $this->HotelQuery->findHotel($hotel_id);
                        $vehicle = $this->VehiclesQuery->findVehicles($vehicle_id);
                        foreach ($customers_arr as $cid) {
                            $customer = $this->CustomerQuery->findCustomer($cid);
                            $price = $this->calculatePrice(
                                $customer,
                                $tour,
                                $hotel,
                                $vehicle,
                                $start_date,
                                $end_date,
                                count($customers_arr)
                            );
                            $is_main = ($cid == $main) ? 1 : 0;
                            $this->bookingQuery->addBookingCustomers($id, $cid, $is_main, $price);
                            $this->bookingQuery->addAttendance($id, $cid);
                            if ($status == 'da_hoan_thanh') {
                                $this->bookingQuery->updateHistoryGuideTour($id);
                            }
                        }

                        echo "<script>alert('Cập nhật booking thành công!'); window.location.href='?action=admin-listBooking';</script>";
                        exit;
                    }
                }
            }
        }
        $selected_customers = $customers_arr ?? $selected_old;
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