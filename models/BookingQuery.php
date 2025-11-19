<?php
class BookingQuery extends BaseModel {
    public $booking_id;
    public $tour_id;
    public $customer_id;
    public $hotel_service_id;
    public $vehicle_service_id;
    public $status;
    public $created_at;
    public $days;
    public $nights;
    public $report;

    public function getAllBooking() {
        $sql = "SELECT 
                    b.*,
                    t.tour_name,
                    h.service_name AS hotel_name,
                    v.service_name AS vehicle_name
                FROM bookings b
                LEFT JOIN tours t ON b.tour_id = t.tour_id
                LEFT JOIN hotels h ON b.hotel_id = h.hotel_service_id
                LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_service_id
                ORDER BY b.booking_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBooking($id) {
        $sql = "SELECT 
                    b.*, 
                    t.tour_name
                FROM bookings b
                LEFT JOIN tours t ON b.tour_id = t.tour_id
                WHERE b.booking_id = ?";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function getGuideByBooking($booking_id) {
        $sql = "SELECT 
                    g.*, 
                    u.name AS guide_name, 
                    u.phone, 
                    u.email,
                    tg.start_date, 
                    tg.end_date, 
                    tg.status
                FROM bookings b
                JOIN tour_guides tg ON b.tour_id = tg.tour_id
                JOIN guides g ON tg.guide_id = g.guide_id
                JOIN users u ON g.user_id = u.user_id
                WHERE b.booking_id = ?";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([$booking_id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function getBookingCustomers($booking_id) {
        $sql = "SELECT 
                    c.*, 
                    bc.id AS bc_id
                FROM booking_customers bc
                JOIN customers c ON bc.customer_id = c.customer_id
                WHERE bc.booking_id = ?";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([$booking_id]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAttendance($booking_id) {
        $sql = "SELECT  
                    a.*, 
                    c.full_name
                FROM attendance a
                JOIN customers c ON a.customer_id = c.customer_id
                WHERE a.booking_id = ?";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([$booking_id]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>