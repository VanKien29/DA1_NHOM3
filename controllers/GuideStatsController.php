<?php
class GuideStatsController {

    private $bookingQuery;

    public function __construct() {
        $this->bookingQuery = new BookingQuery();
    }

    public function stats() {
        $user_id = $_SESSION['user']['id'];

        // Lấy guide_id theo user
        $guide = $this->bookingQuery->getGuideByUserId($user_id);
        $guide_id = $guide['guide_id'];

        // Tổng số tour
        $totalTours = $this->bookingQuery->countToursByGuide($guide_id);

        // Tour đã hoàn thành
        $finishedTours = $this->bookingQuery->countFinishedToursByGuide($guide_id);

        // Tour đang diễn ra
        $runningTours = $this->bookingQuery->countRunningToursByGuide($guide_id);

        // Số khách đã phục vụ
        $totalCustomers = $this->bookingQuery->countCustomersByGuide($guide_id);

        require './views/GuideStats/Stats.php';
    }
}
