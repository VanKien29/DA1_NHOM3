<?php
class StatisticController
{
    private $reportQuery;

    public function __construct()
    {
        $this->reportQuery = new StatisticQuery();
    }

    // Hàm tự fill 12 tháng
    private function fillMonths($rows, $field)
    {
        $result = [];

        for ($i = 1; $i <= 12; $i++) {
            $result[$i] = [
                'month' => $i,
                $field => 0
            ];
        }

        foreach ($rows as $r) {
            $m = (int)$r['month'];
            $result[$m][$field] = $r[$field];
        }

        return array_values($result);
    }

    public function dashboard()
    {
        $data = [];

        // Tổng số liệu
        $data['total_tours']     = $this->reportQuery->getTotalTours();
        $data['total_bookings']  = $this->reportQuery->getTotalBookings();
        $data['total_customers'] = $this->reportQuery->getTotalCustomers();
        $data['total_guides']    = $this->reportQuery->getTotalGuides();
        $data['total_revenue']   = $this->reportQuery->getTotalRevenue();

        // Booking theo tháng (fill đủ 12 tháng)
        $bm = $this->reportQuery->getBookingByMonth();
        $data['booking_month'] = $this->fillMonths($bm, 'total');

        // Revenue theo tháng
        $rm = $this->reportQuery->getRevenueByMonth();
        $data['revenue_month'] = $this->fillMonths($rm, 'revenue');

        // Top lists
        $data['top_tours']  = $this->reportQuery->getTopTours();
        $data['top_guides'] = $this->reportQuery->getTopGuides();

        require './views/Statistic/Statistic.php';
    }
}