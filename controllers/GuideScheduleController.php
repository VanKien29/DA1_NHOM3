<?php
class GuideScheduleController {
    private $bookingQuery;

    function __construct() {
        $this->bookingQuery = new BookingQuery();
    }

    public function mySchedule() { 
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

    public function detaillBooking($id) {
        $booking    = $this->bookingQuery->getFullBooking($id);
        $guide      = $this->bookingQuery->getGuideByBooking($id);
        $customers  = $this->bookingQuery->getBookingCustomers($id);
        $attendance = $this->bookingQuery->getAttendance($id);

        require './views/Guides/DetaillBooking.php';
    }
}
