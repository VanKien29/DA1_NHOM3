<?php
class GuideScheduleController
{
    private $bookingQuery;

    function __construct()
    {
        $this->bookingQuery = new BookingQuery();
    }

    public function mySchedule()
    {
        $user_id = $_SESSION['user']['id'];

        // lấy guide_id theo user_id
        $guide = $this->bookingQuery->getGuideByUserId($user_id);

        if (!$guide) {
            die("Không tìm thấy guide_id cho user_id = " . $user_id);
        }

        $guide_id = $guide['guide_id'];

        // Lấy lịch tour theo guide_id
        $schedule = $this->bookingQuery->getBookingsByGuide($guide_id);

        require './views/Guides/Schedule.php';
    }

    public function detaillBooking($id)
    {
        $booking = $this->bookingQuery->getFullBooking($id);
        $guide = $this->bookingQuery->getGuideByBooking($id);
        $customers = $this->bookingQuery->getBookingCustomers($id);
        $attendance = $this->bookingQuery->getAttendance($id);

        require './views/Guides/DetaillBooking.php';
    }
    // cập nhật trạng thái điểm danh
    public function updateAttendance()
    {
        if (!isset($_POST['attendance_id']) || !isset($_POST['status']) || !isset($_POST['booking_id'])) {
            die('Thiếu dữ liệu');
        }
        $attendance_id = $_POST['attendance_id'];
        $status = $_POST['status'];
        $booking_id = $_POST['booking_id'];

        $this->bookingQuery->updateAttendance($attendance_id, $status);
        header("Location: ?action=guide-detaillBooking&id=" . $booking_id);
        exit;
    }
}
