<?php
// controllers/StatisticController.php

class StatisticController
{
    private $statisticQuery;

    public function __construct()
    {
        $this->statisticQuery = new StatisticQuery();
    }

    // Fill đủ 12 tháng cho mảng thống kê
    private function fillMonths(array $rows, string $field)
    {
        $result = [];

        // Khởi tạo 12 tháng = 0
        for ($i = 1; $i <= 12; $i++) {
            $result[$i] = [
                'month' => $i,
                $field  => 0
            ];
        }

        // Ghi đè những tháng có dữ liệu
        foreach ($rows as $r) {
            $m = (int) $r['month'];
            if ($m >= 1 && $m <= 12) {
                $result[$m][$field] = (float) $r[$field];
            }
        }

        // Trả về dạng array 0-based cho json_encode
        return array_values($result);
    }

    public function dashboard()
    {
        // Năm hiện tại hoặc lấy từ GET ?year=
        $year = isset($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');

        $data = [];

        // Thông tin năm
        $data['year'] = $year;

        // Tổng số liệu
        $data['total_tours']     = $this->statisticQuery->getTotalTours();
        $data['total_customers'] = $this->statisticQuery->getTotalCustomers();
        $data['total_guides']    = $this->statisticQuery->getTotalGuides();

        // Tổng booking & doanh thu theo năm
        $data['total_bookings']  = $this->statisticQuery->getTotalBookings($year);
        $data['total_revenue']   = $this->statisticQuery->getTotalRevenue($year);

        // Booking theo tháng (fill đủ 12 tháng)
        $bm = $this->statisticQuery->getBookingByMonth($year);
        $data['booking_month'] = $this->fillMonths($bm, 'total');

        // Doanh thu theo tháng
        $rm = $this->statisticQuery->getRevenueByMonth($year);
        $data['revenue_month'] = $this->fillMonths($rm, 'revenue');

        // Top lists theo năm
        $data['top_tours']  = $this->statisticQuery->getTopTours($year);
        $data['top_guides'] = $this->statisticQuery->getTopGuides($year);

        require './views/Statistic/Statistic.php';
    }
}