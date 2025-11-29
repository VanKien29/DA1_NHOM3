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
    }

    public function listBooking()
    {
        $filter = $_GET['filter'] ?? '';
        $bookings = $this->bookingQuery->getBookingsByFilter($filter);
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

    public function detailBooking($id)
    {
        $booking = $this->bookingQuery->getBooking($id);
        $guide = $this->bookingQuery->getGuideByBooking($id);
        $customers = $this->bookingQuery->getBookingCustomers($id);
        $attendance = $this->bookingQuery->getAttendance($id);
        $customers_all = $this->CustomerQuery->getAllCustomers();

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
            $this->bookingQuery->addBookingCustomers($id, $new_customer, 0);
            $this->bookingQuery->addAttendance($id, $new_customer);
            $_SESSION['message'] = "Thêm khách thành công!";
            header("Location: ?action=admin-detailBooking&id=" . $id);
            exit;
        }
        require './views/Booking/DetailBooking.php';
    }

    function createBooking()
    {
        $guides = $this->GuideQuery->getAllGuides();
        $hotels = $this->HotelQuery->getAllHotel();
        $tours = $this->ToursQuery->getAllTours();
        $vehicles = $this->VehiclesQuery->getAllVehicles();
        $customers = $this->CustomerQuery->getAllCustomers();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tour_id = $_POST['tour_id'];
            $guide_id = $_POST['guide_id'];
            $hotel_id = $_POST['hotel_id'];
            $vehicle_id = $_POST['vehicle_id'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $customers_arr = $_POST['customers'] ?? [];
            $main_customer = $_POST['main_customer'];
            $selectedRooms = $_POST['room_ids'] ?? [];

            $err = [];
            $conflict_customer = [];
            if (empty($tour_id) || empty($guide_id) || empty($hotel_id) || empty($vehicle_id)) {
                $err['empty'] = "<script>alert('Vui lòng chọn đầy đủ Tour, HDV, Khách sạn và Phương tiện.');</script>";
            }
            if (empty($customers_arr) || count($customers_arr) < 3) {
                $err['customers'] = "Booking phải có ít nhất 3 khách.";
            }
            if (!empty($main_customer) && !in_array($main_customer, $customers_arr)) {
                $err['main'] = "Khách đại diện phải nằm trong danh sách khách đã chọn.";
            }
            if (empty($start_date) || empty($end_date)) {
                $err['date'] = "Vui lòng chọn ngày đi và ngày về.";
            }
            if (!empty($start_date) && !empty($end_date) && $end_date <= $start_date) {
                $err['date'] = "Ngày về phải lớn hơn ngày đi.";
            }
            if (empty($err)) {

                if (empty($selectedRooms)) {
                    $err['rooms'] = "Bạn phải chọn ít nhất 1 phòng!";
                }
                $bookedRooms = $this->bookingQuery->getBookedRoomIds($hotel_id, $start_date, $end_date);
                foreach ($selectedRooms as $rid) {
                    if (in_array($rid, $bookedRooms)) {
                        $err['rooms'] = "Một trong các phòng bạn chọn đã có khách đặt!";
                        break;
                    }
                }
                if ($this->bookingQuery->checkGuideConflict($guide_id, $start_date, $end_date)) {
                    $err['guide'] = "HDV đã có tour trùng lịch trong khoảng thời gian này.";
                }
                foreach ($customers_arr as $c_id) {
                    if ($this->bookingQuery->checkCustomerConflict($c_id, $start_date, $end_date)) {
                        $conflict_customer[] = $c_id;
                    }
                }
                if (!empty($conflict_customer)) {
                    $err['customers_conflict'] = "Một số khách đã có tour trùng lịch.";
                }
            }
            if (!empty($err)) {
                require './views/Booking/CreateBooking.php';
                return;
            }
            $this->bookingQuery->tour_id = $tour_id;
            $this->bookingQuery->guide_id = $guide_id;
            $this->bookingQuery->hotel_id = $hotel_id;
            $this->bookingQuery->vehicle_id = $vehicle_id;
            $this->bookingQuery->start_date = $start_date;
            $this->bookingQuery->end_date = $end_date;
            $this->bookingQuery->status = 'dang_dien_ra';
            $this->bookingQuery->report = '';
            $this->bookingQuery->created_at = date('Y-m-d H:i:s');
            $this->bookingQuery->room_ids = $selectedRooms;

            $booking_id = $this->bookingQuery->createBooking();

            foreach ($customers_arr as $value) {
                $is_main = (!empty($main_customer) && $value == $main_customer) ? 1 : 0;
                $this->bookingQuery->addBookingCustomers($booking_id, $value, $is_main);
                $this->bookingQuery->addAttendance($booking_id, $value);
            }

            if ($this->bookingQuery->addGuideTour($guide_id, $booking_id, $tour_id)) {
                echo "<script>alert('Thêm booking thành công!'); window.location.href='?action=admin-listBooking';</script>";
                exit;
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

        // Lấy booking + khách + phòng hiện tại
        $booking = $this->bookingQuery->getBooking($id);
        $oldCustomers = $this->bookingQuery->getBookingCustomers($id);
        $currentRoomIds = $this->bookingQuery->getRoomIdsByBooking($id);

        $selectedCustomers = array_column($oldCustomers, 'customer_id');

        $main_customer_old = "";
        foreach ($oldCustomers as $c) {
            if ($c['is_main'] == 1) {
                $main_customer_old = $c['customer_id'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tour_id = $_POST['tour_id'];
            $guide_id = $_POST['guide_id'];
            $hotel_id = $_POST['hotel_id'];
            $vehicle_id = $_POST['vehicle_id'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $customers_arr = $_POST['customers'] ?? [];
            $main_customer = $_POST['main_customer'];
            $status = $_POST['status'];

            $selectedRooms = $_POST['room_ids'] ?? [];

            $err = [];
            $conflict_customer = [];

            if (empty($tour_id) || empty($guide_id) || empty($hotel_id) || empty($vehicle_id)) {
                $err['empty'] = "<script>alert('Vui lòng chọn đầy đủ Tour, HDV, Khách sạn và Phương tiện.');</script>";
            }
            if (empty($customers_arr) || count($customers_arr) < 3) {
                $err['customers'] = "Booking phải có ít nhất 3 khách.";
            }
            if (!empty($main_customer) && !in_array($main_customer, $customers_arr)) {
                $err['main'] = "Khách đại diện phải nằm trong danh sách khách đã chọn.";
            }
            if (empty($start_date) || empty($end_date)) {
                $err['date'] = "Vui lòng chọn ngày đi và ngày về.";
            }
            if (!empty($start_date) && !empty($end_date) && $end_date <= $start_date) {
                $err['date'] = "Ngày về phải lớn hơn ngày đi.";
            }

            if (empty($err)) {

                if ($this->bookingQuery->checkGuideConflict($guide_id, $start_date, $end_date, $id)) {
                    $err['guide'] = "HDV đã có tour trùng lịch trong khoảng thời gian này.";
                }

                foreach ($customers_arr as $cid) {
                    if ($this->bookingQuery->checkCustomerConflict($cid, $start_date, $end_date, $id)) {
                        $conflict_customer[] = $cid;
                    }
                }
                if (!empty($conflict_customer)) {
                    $err['customers_conflict'] = "Một số khách đã có tour trùng lịch.";
                }
            }

            if (empty($err)) {

                if (empty($selectedRooms)) {
                    $err['rooms'] = "Bạn phải chọn ít nhất 1 phòng!";
                }

                $bookedRooms = $this->bookingQuery->getBookedRoomIds($hotel_id, $start_date, $end_date, $id);

                foreach ($selectedRooms as $rid) {

                    if (!in_array($rid, $currentRoomIds) && in_array($rid, $bookedRooms)) {
                        $err['rooms'] = "Một số phòng bạn chọn đang có khách khác đặt!";
                        break;
                    }
                }
            }
            if (!empty($err)) {
                require './views/Booking/updateBooking.php';
                return;
            }
            $this->bookingQuery->room_ids = $selectedRooms;

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
            $this->bookingQuery->deleteBookingCustomersOnly($id);
            $this->bookingQuery->deleteAttendanceOnly($id);

            foreach ($customers_arr as $value) {
                $is_main = (!empty($main_customer) && $value == $main_customer) ? 1 : 0;
                $this->bookingQuery->addBookingCustomers($id, $value, $is_main);
                $this->bookingQuery->addAttendance($id, $value);
            }

            echo "<script>alert('Cập nhật booking thành công!'); 
            window.location.href='?action=admin-listBooking';</script>";
            exit;
        }

        require './views/Booking/updateBooking.php';
    }



    public function deleteBooking($id)
    {
        if ($this->bookingQuery->deleteBooking($id)) {
            echo "<script>
                alert('Xóa booking thành công!');
                window.location.href='?action=admin-listBooking';
            </script>";
        } else {
            echo "<script>
                alert('Không thể xóa booking này!');
                window.location.href='?action=admin-listBooking';
            </script>";
        }
        exit;
    }

}
?>