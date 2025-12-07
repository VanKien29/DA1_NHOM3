<?php
class GuideStatsController {

    private $bookingQuery;

    public function __construct() {
        $this->bookingQuery = new BookingQuery();
    }

    public function stats() {
    $user_id = $_SESSION['user']['id'];

    // Lấy guide info
    $guide = $this->bookingQuery->getGuideByUserId($user_id);
    $guide_id = $guide['guide_id'];

    // Dữ liệu tổng quan
    $totalTours = $this->bookingQuery->countToursByGuide($guide_id);
    $finishedTours = $this->bookingQuery->countFinishedToursByGuide($guide_id);
    $runningTours = $this->bookingQuery->countRunningToursByGuide($guide_id);
    $totalCustomers = $this->bookingQuery->countCustomersByGuide($guide_id);

    // Lịch sử tour HDV
    $historyTours = $this->bookingQuery->getHistoryTours($guide_id);


    require './views/GuideStats/Stats.php';
}

}
