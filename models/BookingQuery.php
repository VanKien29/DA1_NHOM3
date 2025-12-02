<?php
class BookingQuery extends BaseModel
{
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

    public function getAllBooking()
    {
        $sql = "SELECT 
                    b.*,
                    t.tour_name,
                    h.service_name AS hotel_name,
                    v.service_name AS vehicle_name,
                    u.name AS guide_name,
                    COUNT(bc.customer_id) AS total_customers
                FROM bookings b
                LEFT JOIN tours t ON b.tour_id = t.tour_id
                LEFT JOIN hotels h ON b.hotel_id = h.hotel_service_id
                LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_service_id
                LEFT JOIN guides g ON b.guide_id = g.guide_id
                LEFT JOIN users u ON g.user_id = u.user_id
                LEFT JOIN booking_customers bc ON b.booking_id = bc.booking_id
                GROUP BY b.booking_id
                ORDER BY 
                    CASE b.status
                        WHEN 'dang_dien_ra' THEN 1
                        WHEN 'cho_duyet' THEN 2
                        WHEN 'da_huy' THEN 3
                        WHEN 'da_hoan_thanh' THEN 4
                        ELSE 5
                    END,
                    b.booking_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBooking($id)
    {
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

    public function getGuideByBooking($booking_id)
    {
        $sql = "SELECT 
                    g.*, 
                    u.name AS guide_name, 
                    u.phone, 
                    u.email,
                    b.status,
                    b.start_date,
                    b.end_date
                FROM bookings b
                LEFT JOIN guides g ON b.guide_id = g.guide_id
                LEFT JOIN users u ON g.user_id = u.user_id
                WHERE b.booking_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$booking_id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function getBookingCustomers($booking_id)
    {
        $sql = "SELECT 
                c.*, 
                bc.id AS bc_id,
                bc.is_main
            FROM booking_customers bc
            JOIN customers c ON bc.customer_id = c.customer_id
            WHERE bc.booking_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$booking_id]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAttendance($booking_id)
    {
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

    public function createBooking()
    {
        $sql = "INSERT INTO bookings
        (tour_id, guide_id, hotel_id, vehicle_id, status, report, created_at, start_date, end_date)
        VALUES (:tour_id, :guide_id, :hotel_id, :vehicle_id, :status, :report, :created_at, :start_date, :end_date)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':guide_id', $this->guide_id);
        $stmt->bindParam(':hotel_id', $this->hotel_id);
        $stmt->bindParam(':vehicle_id', $this->vehicle_id);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':report', $this->report);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function addBookingCustomers($booking_id, $customer_id, $is_main)
    {
        $sql = "INSERT INTO booking_customers (booking_id, customer_id, is_main) VALUES (:booking_id, :customer_id, :is_main)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':is_main', $is_main);
        $stmt->execute();
    }

    public function addGuideTour($guide_id, $booking_id, $tour_id)
    {
        $sql = "INSERT INTO guide_tours (guide_id, booking_id, tour_id, status) VALUES (:guide_id, :booking_id, :tour_id, :status)";
        $status = 'current';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':guide_id', $guide_id);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function addAttendance($booking_id, $customer_id)
    {
        $sql = "INSERT INTO attendance (booking_id, customer_id, status) VALUES (:booking_id, :customer_id, :status)";
        $status = 'absent';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function checkGuideConflict($guide_id, $start, $end, $booking_id = null)
    {
        $sql = "SELECT * FROM bookings 
                WHERE guide_id = :guide_id
                AND start_date <= :end
                AND end_date >= :start";
        if ($booking_id) {
            $sql .= " AND booking_id != :booking_id";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':guide_id', $guide_id);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        if ($booking_id) {
            $stmt->bindParam(':booking_id', $booking_id);
        }
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkCustomerConflict($customer_id, $start, $end, $booking_id = null)
    {
        $sql = "SELECT * FROM bookings b
                JOIN booking_customers bc ON b.booking_id = bc.booking_id
                WHERE bc.customer_id = :customer_id
                AND b.start_date <= :end
                AND b.end_date >= :start";
        if ($booking_id) {
            $sql .= " AND b.booking_id != :booking_id";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        if ($booking_id) {
            $stmt->bindParam(':booking_id', $booking_id);
        }
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBooking($id, $tour_id, $guide_id, $hotel_id, $vehicle_id, $status, $start_date, $end_date)
    {
        $sql = "UPDATE bookings SET 
                tour_id = :tour_id, 
                guide_id = :guide_id, 
                hotel_id = :hotel_id, 
                vehicle_id = :vehicle_id, 
                status = :status, 
                start_date = :start_date, 
                end_date = :end_date
            WHERE booking_id = :booking_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->bindParam(':guide_id', $guide_id);
        $stmt->bindParam(':hotel_id', $hotel_id);
        $stmt->bindParam(':vehicle_id', $vehicle_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':booking_id', $id);
        $stmt->execute();
        return true;
    }

    public function getBookingsByFilter($filter)
    {
        $sql = "SELECT 
            b.*, 
            t.tour_name, 
            h.service_name AS hotel_name,
            v.service_name AS vehicle_name,
            u.name AS guide_name,
            (SELECT COUNT(*) FROM booking_customers bc WHERE bc.booking_id = b.booking_id) AS total_customers
        FROM bookings b
        LEFT JOIN tours t ON b.tour_id = t.tour_id
        LEFT JOIN hotels h ON b.hotel_id = h.hotel_service_id
        LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_service_id
        LEFT JOIN guides g ON b.guide_id = g.guide_id
        LEFT JOIN users u ON g.user_id = u.user_id
        WHERE 1";

        switch ($filter) {
            case 'today':
                $sql .= " AND b.start_date = CURDATE()";
                break;
            case '3days':
                $sql .= " AND b.start_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 3 DAY";
                break;
            case '7days':
                $sql .= " AND b.start_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 7 DAY";
                break;
            case '1month':
                $sql .= " AND b.start_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 MONTH";
                break;
            case 'yesterday':
                $sql .= " AND b.start_date = CURDATE() - INTERVAL 1 DAY";
                break;
            case '3days_ago':
                $sql .= " AND b.start_date BETWEEN CURDATE() - INTERVAL 3 DAY AND CURDATE()";
                break;
            case '7days_ago':
                $sql .= " AND b.start_date BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()";
                break;
            case '1month_ago':
                $sql .= " AND b.start_date BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()";
                break;
        }
        $sql .= " GROUP BY b.booking_id  ORDER BY 
                CASE b.status
                    WHEN 'dang_dien_ra' THEN 1
                    WHEN 'cho_duyet' THEN 2
                    WHEN 'da_huy' THEN 3
                    WHEN 'da_hoan_thanh' THEN 4
                    ELSE 5
                END,
                b.booking_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomerIdByBCId($bc_id)
    {
        $sql = "SELECT customer_id, booking_id FROM booking_customers WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$bc_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteBookingCustomersOnly($booking_id)
    {
        $sql = "DELETE FROM booking_customers WHERE booking_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$booking_id]);
    }

    public function deleteAttendanceOnly($booking_id)
    {
        $sql = "DELETE FROM attendance WHERE booking_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$booking_id]);
    }

    public function deleteCustomerFromBooking($bc_id)
    {
        $sql = "DELETE FROM booking_customers WHERE id = ?";
        $stm = $this->pdo->prepare($sql);
        return $stm->execute([$bc_id]);
    }

    public function deleteAttendanceByCustomer($booking_id, $customer_id)
    {
        $sql = "DELETE FROM attendance WHERE booking_id = ? AND customer_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$booking_id, $customer_id]);
    }

    public function deleteBooking($booking_id)
    {
        $sql = "DELETE FROM attendance WHERE booking_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$booking_id]);

        $sql = "DELETE FROM booking_customers WHERE booking_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$booking_id]);

        $sql = "DELETE FROM guide_tours WHERE booking_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$booking_id]);

        $sql = "DELETE FROM bookings WHERE booking_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$booking_id]);
    }

    public function getBookingsByGuide($guide_id, $filter = '')
    {
        $sql = "SELECT 
                    b.booking_id,
                    b.start_date,
                    b.end_date,
                    b.status,
                    h.service_name AS hotel_name,
                    v.service_name AS vehicle_name,
                    t.tour_name,
                    COUNT(bc.customer_id) AS total_customers
                FROM bookings b
                JOIN guides g ON b.guide_id = g.guide_id
                LEFT JOIN tours t ON b.tour_id = t.tour_id
                LEFT JOIN booking_customers bc ON b.booking_id = bc.booking_id
                LEFT JOIN hotels h ON b.hotel_id = h.hotel_service_id
                LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_service_id
                WHERE g.guide_id = :guide_id";

        switch ($filter) {
            case 'today':
                $sql .= " AND b.start_date = CURDATE()";
                break;
            case '3days':
                $sql .= " AND b.start_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 3 DAY";
                break;
            case '7days':
                $sql .= " AND b.start_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 7 DAY";
                break;
            case '1month':
                $sql .= " AND b.start_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 MONTH";
                break;
            case 'yesterday':
                $sql .= " AND b.start_date = CURDATE() - INTERVAL 1 DAY";
                break;
            case '3days_ago':
                $sql .= " AND b.start_date BETWEEN CURDATE() - INTERVAL 3 DAY AND CURDATE()";
                break;
            case '7days_ago':
                $sql .= " AND b.start_date BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()";
                break;
            case '1month_ago':
                $sql .= " AND b.start_date BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()";
                break;
        }

        $sql .= " GROUP BY b.booking_id";
        $sql .= " ORDER BY 
                    CASE b.status
                        WHEN 'dang_dien_ra' THEN 1
                        WHEN 'cho_duyet' THEN 2
                        WHEN 'da_huy' THEN 3
                        WHEN 'da_hoan_thanh' THEN 4
                        ELSE 5
                    END,
                    b.start_date ASC";

        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':guide_id', $guide_id);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFullBooking($booking_id)
    {
        $sql = "SELECT 
                b.*, 
                t.tour_name,
                h.service_name AS hotel_name,
                v.service_name AS vehicle_name
            FROM bookings b
            LEFT JOIN tours t ON b.tour_id = t.tour_id
            LEFT JOIN hotels h ON b.hotel_id = h.hotel_service_id
            LEFT JOIN vehicles v ON b.vehicle_id = v.vehicle_service_id
            WHERE b.booking_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$booking_id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function getGuideByUserId($user_id)
    {
        $sql = "SELECT guide_id FROM guides WHERE user_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$user_id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAttendance($attendance_id, $status)
    {
        $sql = "UPDATE attendance SET status = :status
                WHERE id = :attendance_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':status' => $status,
            ':attendance_id' => $attendance_id
        ]);
        return true;
    }

    public function getVehicleByBooking($booking_id)
    {
        $sql = "SELECT v.*
            FROM bookings b
            JOIN vehicles v ON b.vehicle_id = v.vehicle_service_id
            WHERE b.booking_id = :booking_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['booking_id' => $booking_id]);
        return $stmt->fetch();
    }
}
?>