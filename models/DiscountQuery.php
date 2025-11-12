<?php
class DiscountQuery extends BaseModel {
    public $code;
    public $description;
    public $discount_type;
    public $value;
    public $start_date;
    public $end_date;
    public $tour_id;
    public $status;

    public function getAllDiscounts() {
        $sql = "SELECT d.*, t.tour_name 
                FROM discounts d 
                LEFT JOIN tours t ON d.tour_id = t.tour_id
                ORDER BY d.discount_id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findDiscount($id) {
        $sql = "SELECT * FROM discounts WHERE discount_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createDiscount() {
        $sql = "INSERT INTO discounts (code, description, discount_type, value, start_date, end_date, tour_id, status)
                VALUES (:code, :description, :discount_type, :value, :start_date, :end_date, :tour_id, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':discount_type', $this->discount_type);
        $stmt->bindParam(':value', $this->value);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':status', $this->status);
        return $stmt->execute();
    }

    public function updateDiscount($id) {
        $sql = "UPDATE discounts SET 
                    code = :code, 
                    description = :description, 
                    discount_type = :discount_type,
                    value = :value,
                    start_date = :start_date,
                    end_date = :end_date,
                    tour_id = :tour_id,
                    status = :status
                WHERE discount_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':discount_type', $this->discount_type);
        $stmt->bindParam(':value', $this->value);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteDiscount($id) {
        $sql = "DELETE FROM discounts WHERE discount_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>