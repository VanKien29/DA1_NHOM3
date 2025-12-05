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


    public function detailGuideBooking($id)
    {
        $booking = $this->bookingQuery->getFullBooking($id);
        $guide = $this->bookingQuery->getGuideByBooking($id);
        $customers = $this->bookingQuery->getBookingCustomers($id);
        $attendance = $this->bookingQuery->getAttendance($id);
        $vehicle = $this->bookingQuery->getVehicleByBooking($id);
        $schedules = $this->tourScheduleQuery->getSchedulesByTourId($booking['tour_id']);

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

        $this->bookingQuery->updateAttendance($attendance_id, $status);
        header("Location: ?action=guide-detailGuideBooking&id=$booking_id");
        exit;
    }

    public function updateStatusByGuide() {
        $booking_id = $_POST['booking_id'];
        $status = $_POST['status'];
        if (!in_array($status, ['dang_dien_ra', 'da_hoan_thanh'])) {
            $_SESSION['msg'] = "Hướng dẫn viên không được phép cập nhật trạng thái này!";
            header("Location: ?action=guide-detailGuideBooking&id=".$booking_id);
            exit;
        }
        $this->bookingQuery->updateStatus($booking_id, $status);
        $_SESSION['msg'] = "Cập nhật trạng thái thành công!";
        header("Location: ?action=guide-detailGuideBooking&id=$booking_id");
        exit;
}

}