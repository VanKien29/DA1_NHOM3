<?php
class StatisticQuery extends BaseModel
{
    // Tổng tour
    public function getTotalTours() {
        $sql = "SELECT COUNT(*) AS total FROM tours";
        return $this->pdo->query($sql)->fetch()['total'];
    }

    // Tổng booking
    public function getTotalBookings() {
        $sql = "SELECT COUNT(*) AS total FROM bookings";
        return $this->pdo->query($sql)->fetch()['total'];
    }

    // Tổng khách hàng
    public function getTotalCustomers() {
        $sql = "SELECT COUNT(*) AS total FROM customers";
        return $this->pdo->query($sql)->fetch()['total'];
    }

    // Tổng hướng dẫn viên
    public function getTotalGuides() {
        $sql = "SELECT COUNT(*) AS total FROM guides";
        return $this->pdo->query($sql)->fetch()['total'];
    }

    // Tổng doanh thu
    public function getTotalRevenue() {
        $sql = "
            SELECT SUM(bc.price_per_customer) AS revenue
            FROM booking_customers bc
        ";
        return $this->pdo->query($sql)->fetch()['revenue'] ?? 0;
    }

    // Booking theo tháng
    public function getBookingByMonth() {
        $sql = "
            SELECT MONTH(created_at) AS month, COUNT(*) AS total
            FROM bookings
            GROUP BY MONTH(created_at)
            ORDER BY MONTH(created_at)
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Doanh thu theo tháng
    public function getRevenueByMonth() {
        $sql = "
            SELECT MONTH(b.created_at) AS month,
                   SUM(bc.price_per_customer) AS revenue
            FROM bookings b
            JOIN booking_customers bc ON b.booking_id = bc.booking_id
            GROUP BY MONTH(b.created_at)
            ORDER BY MONTH(b.created_at)
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Top 5 tour bán chạy
    public function getTopTours() {
        $sql = "
            SELECT t.tour_name, COUNT(b.booking_id) AS total
            FROM bookings b
            JOIN tours t ON b.tour_id = t.tour_id
            GROUP BY t.tour_id
            ORDER BY total DESC
            LIMIT 5
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Top 5 hướng dẫn viên dẫn nhiều tour nhất
    public function getTopGuides() {
        $sql = "
            SELECT u.name AS guide_name, COUNT(b.booking_id) AS total
            FROM bookings b
            JOIN guides g ON b.guide_id = g.guide_id
            JOIN users u ON g.user_id = u.user_id
            GROUP BY g.guide_id
            ORDER BY total DESC
            LIMIT 5
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}