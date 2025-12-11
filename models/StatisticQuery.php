<?php
// models/StatisticQuery.php

class StatisticQuery extends BaseModel
{
    // Tổng tour (all time)
    public function getTotalTours()
    {
        $sql = "SELECT COUNT(*) AS total FROM tours";
        $stmt = $this->pdo->query($sql);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    // Tổng khách hàng (all time)
    public function getTotalCustomers()
    {
        $sql = "SELECT COUNT(*) AS total FROM customers";
        $stmt = $this->pdo->query($sql);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    // Tổng hướng dẫn viên (all time)
    public function getTotalGuides()
    {
        $sql = "SELECT COUNT(*) AS total FROM guides";
        $stmt = $this->pdo->query($sql);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    // Tổng booking theo năm
    public function getTotalBookings($year)
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM bookings
            WHERE start_date IS NOT NULL
              AND YEAR(start_date) = :year
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    // Tổng doanh thu theo năm (tính từ booking_customers)
    public function getTotalRevenue($year)
    {
        $sql = "
            SELECT SUM(bc.price_per_customer) AS revenue
            FROM bookings b
            JOIN booking_customers bc ON b.booking_id = bc.booking_id
            WHERE b.status = 'da_hoan_thanh'
            AND YEAR(b.start_date) = :year
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return (float) ($stmt->fetch()['revenue'] ?? 0);
    }


    // Booking theo tháng (dựa trên start_date)
    public function getBookingByMonth($year)
    {
        $sql = "
            SELECT 
                MONTH(start_date) AS month,
                COUNT(*) AS total
            FROM bookings
            WHERE status = 'da_hoan_thanh'
            AND YEAR(start_date) = :year
            GROUP BY MONTH(start_date)
            ORDER BY MONTH(start_date)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Doanh thu theo tháng
    public function getRevenueByMonth($year)
    {
        $sql = "
            SELECT 
                MONTH(b.start_date) AS month,
                SUM(bc.price_per_customer) AS revenue
            FROM bookings b
            JOIN booking_customers bc ON b.booking_id = bc.booking_id
            WHERE b.status = 'da_hoan_thanh'
            AND YEAR(b.start_date) = :year
            GROUP BY MONTH(b.start_date)
            ORDER BY MONTH(b.start_date)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Top 5 tour bán chạy theo năm (theo số booking)
    public function getTopTours($year)
    {
        $sql = "
            SELECT 
                t.tour_name, 
                COUNT(b.booking_id) AS total
            FROM bookings b
            JOIN tours t ON b.tour_id = t.tour_id
            WHERE b.start_date IS NOT NULL
              AND YEAR(b.start_date) = :year
            GROUP BY t.tour_id
            ORDER BY total DESC
            LIMIT 5
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Top 5 hướng dẫn viên dẫn nhiều tour nhất theo năm
    public function getTopGuides($year)
    {
        $sql = "
            SELECT 
                u.name AS guide_name, 
                COUNT(b.booking_id) AS total
            FROM bookings b
            JOIN guides g ON b.guide_id = g.guide_id
            JOIN users u ON g.user_id = u.user_id
            WHERE b.status = 'da_hoan_thanh'
            AND YEAR(b.start_date) = :year
            GROUP BY g.guide_id
            ORDER BY total DESC
            LIMIT 5
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // 5 tour đang diễn ra
    public function getRunningTours($year){
        $sql = "
            SELECT b.*, t.tour_name, u.name AS guide_name
            FROM bookings b
            JOIN tours t ON b.tour_id = t.tour_id
            JOIN guides g ON b.guide_id = g.guide_id
            JOIN users u ON g.user_id = u.user_id
            WHERE b.status = 'dang_dien_ra'
            AND YEAR(b.start_date) = :year
            ORDER BY b.start_date ASC
            LIMIT 5
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // 5 tour sắp diễn ra
    public function getUpcomingTours($year){
        $sql = "
            SELECT b.*, t.tour_name, u.name AS guide_name
            FROM bookings b
            JOIN tours t ON b.tour_id = t.tour_id
            JOIN guides g ON b.guide_id = g.guide_id
            JOIN users u ON g.user_id = u.user_id
            WHERE b.status = 'sap_dien_ra'
            AND YEAR(b.start_date) = :year
            ORDER BY b.start_date ASC
            LIMIT 5
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}