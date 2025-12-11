<?php
class GuideScheduleController
{
    private $bookingQuery;

    function __construct()
    {
        $this->bookingQuery = new BookingQuery();
        $this->tourScheduleQuery = new TourScheduleQuery();
    }

    public function mySchedule()
    {
        $filter = $_GET['filter'] ?? '';
        $user_id = $_SESSION['user']['id'];
        $guide = $this->bookingQuery->getGuideByUserId($user_id);
        $guide_id = $guide['guide_id'];
        $schedule = $this->bookingQuery->getBookingsByGuide($guide_id, $filter);
        require './views/Guides/Schedule.php';
    }


    public function detailGuideBooking($id){
        $booking = $this->bookingQuery->getFullBooking($id);
        $guide = $this->bookingQuery->getGuideByBooking($id);
        $customers = $this->bookingQuery->getBookingCustomers($id);
        $vehicle = $this->bookingQuery->getVehicleByBooking($id);
        $schedules = $this->tourScheduleQuery->getSchedulesByTourId($booking['tour_id']);

        $currentDay = isset($_GET['day']) ? (int) $_GET['day'] : 1;
        if ($currentDay < 1) $currentDay = 1;
        if ($currentDay > (int)$booking['days']) $currentDay = (int)$booking['days'];
        $attendance = $this->bookingQuery->getAttendanceByDay($id, $currentDay);
        $day = $currentDay;

        $segments = $this->bookingQuery->getSegmentCustomersByBooking($id);
        $segments_grouped = [];
        foreach ($segments as $s) {
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
                $segments_grouped[$sid]["using"][] = [
                    "customer_id" => $s['customer_id'],
                    "full_name" => $s['full_name'],
                    "segment_price_per_customer" => $s['segment_price_per_customer']
                ];
            } else {
                $segments_grouped[$sid]["excluded"][] = [
                    "customer_id" => $s['customer_id'],
                    "full_name" => $s['full_name']
                ];
            }
        }

        require './views/Guides/detailGuideBooking.php';
    }


    public function updateAttendance()
    {
        if (!isset($_POST['attendance_id']) || !isset($_POST['status']) || !isset($_POST['booking_id'])) {
            die('Thiếu dữ liệu');
        }
        $attendance_id = $_POST['attendance_id'];
        $status = $_POST['status'];
        $booking_id = $_POST['booking_id'];
        $day = isset($_POST['day_number']) ? (int) $_POST['day_number'] : 1;

        $this->bookingQuery->updateAttendance($attendance_id, $status);
        header("Location: ?action=guide-detailGuideBooking&id=$booking_id&day=$day");
        exit;
    }

    public function updateStatusByGuide()
    {
        $booking_id = $_POST['booking_id'];
        $status = $_POST['status'];
        if (!in_array($status, ['dang_dien_ra', 'da_hoan_thanh'])) {
            $_SESSION['msg'] = "Hướng dẫn viên không được phép cập nhật trạng thái này!";
            header("Location: ?action=guide-detailGuideBooking&id=" . $booking_id);
            exit;
        }
        $booking = $this->bookingQuery->getFullBooking($booking_id);
        $today = date("Y-m-d");

        if ($booking['status'] == 'cho_xac_nhan_ket_thuc' && $status == 'dang_dien_ra') {
            $_SESSION['msg'] = "Tour đang chờ xác nhận kết thúc, không thể chuyển về trạng thái 'Đang diễn ra'!";
            header("Location: ?action=guide-detailGuideBooking&id=" . $booking_id);
            exit;
        }
        if ($booking['status'] == 'dang_dien_ra' && $status == 'dang_dien_ra') {
            $_SESSION['msg'] = "Tour đang diễn ra rồi!";
            header("Location: ?action=guide-detailGuideBooking&id=" . $booking_id);
            exit;
        }
        if ($status == 'dang_dien_ra') {
            if ($today < $booking['start_date']) {
                $_SESSION['msg'] = "Chưa đến ngày bắt đầu tour nên không thể xác nhận 'Đang diễn ra'!";
                header("Location: ?action=guide-detailGuideBooking&id=" . $booking_id);
                exit;
            }
        }
        if ($status == 'da_hoan_thanh') {
            if ($today < $booking['end_date']) {
                $_SESSION['msg'] = "Tour chưa kết thúc, bạn không thể xác nhận 'Đã hoàn thành'!";
                header("Location: ?action=guide-detailGuideBooking&id=" . $booking_id);
                exit;
            }
        }
        $this->bookingQuery->updateStatus($booking_id, $status);
        $_SESSION['message'] = "Cập nhật trạng thái thành công!";
        header("Location: ?action=guide-detailGuideBooking&id=$booking_id");
        exit;
    }

    public function updateNote()
    {
        if (!isset($_POST['booking_id']) || !isset($_POST['note'])) {
            die("Thiếu dữ liệu.");
        }

        $booking_id = $_POST['booking_id'];
        $note = trim($_POST['note']);

        $this->bookingQuery->updateNote($booking_id, $note);
        $_SESSION['message'] = "Đã lưu ghi chú thành công!";
        header("Location: ?action=guide-detailGuideBooking&id=" . $booking_id);
        exit;
    }
}