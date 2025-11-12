<?php
class CustomerQuery extends BaseModel {
    public $customer_id;
    public $full_name;
    public $email;
    public $phone;
    public $address;

    // ====== Lấy toàn bộ khách hàng ======
    public function getAllCustomers() {
        $sql = "SELECT * FROM customers ORDER BY customer_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== Tìm khách hàng theo ID ======
    public function findCustomer($id) {
        $sql = "SELECT * FROM customers WHERE customer_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ====== Thêm khách hàng ======
    public function createCustomer() {
        $sql = "INSERT INTO customers (full_name, email, phone, address)
                VALUES (:full_name, :email, :phone, :address)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address', $this->address);
        return $stmt->execute();
    }

    // ====== Cập nhật khách hàng ======
    public function updateCustomer() {
        $sql = "UPDATE customers SET 
                    full_name = :full_name,
                    email = :email,
                    phone = :phone,
                    address = :address
                WHERE customer_id = :customer_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':customer_id', $this->customer_id);
        return $stmt->execute();
    }

    // ====== Xóa khách hàng ======
    public function deleteCustomer($id) {
    $getBookings = $this->pdo->prepare("SELECT booking_id FROM bookings WHERE customer_id = :id");
    $getBookings->bindParam(':id', $id);
    $getBookings->execute();
    $bookings = $getBookings->fetchAll(PDO::FETCH_COLUMN);

    if (!empty($bookings)) {
        $in = str_repeat('?,', count($bookings) - 1) . '?';
        $deleteRevenues = $this->pdo->prepare("DELETE FROM revenues WHERE booking_id IN ($in)");
        $deleteRevenues->execute($bookings);
    }

    $deleteBookings = $this->pdo->prepare("DELETE FROM bookings WHERE customer_id = :id");
    $deleteBookings->bindParam(':id', $id);
    $deleteBookings->execute();

    $sql = "DELETE FROM customers WHERE customer_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}


}
?>