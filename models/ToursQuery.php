<?php

class ToursQuery extends BaseModel {
    public $tour_id;
    public $tour_name;
    public $description;
    public $price;
    public $category_id;
    public $start_date;
    public $end_date;
    public $status;
    public $category_name;

    // ====== Lấy toàn bộ tour ======
    public function getAllTours() {
        $sql = "SELECT t.*, c.category_name 
                FROM tours t
                INNER JOIN categories c ON t.category_id = c.category_id
                ORDER BY t.tour_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // ====== Lấy toàn bộ tour kèm tên danh mục ======
    public function getAllToursWithCategory() {
        $sql = "SELECT t.*, c.category_name
                FROM tours t
                LEFT JOIN categories c ON t.category_id = c.category_id
                ORDER BY t.tour_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== Tìm tour theo ID ======
    public function findTour($id) {
        $sql = "SELECT t.*, c.category_name 
                FROM tours t
                INNER JOIN categories c ON t.category_id = c.category_id
                WHERE t.tour_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ====== Thêm tour ======
    public function createTour() {
        $sql = "INSERT INTO tours (tour_name, description, price, category_id, start_date, end_date, status)
                VALUES (:tour_name, :description, :price, :category_id, :start_date, :end_date, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':status', $this->status);
        return $stmt->execute();
    }

    // ====== Cập nhật tour ======
    public function updateTour() {
        $sql = "UPDATE tours SET 
                    tour_name = :tour_name,
                    description = :description,
                    price = :price,
                    category_id = :category_id,
                    start_date = :start_date,
                    end_date = :end_date,
                    status = :status
                WHERE tour_id = :tour_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':status', $this->status);
        return $stmt->execute();
    }

    // ====== Xóa tour ======
    public function deleteTour($id) {
        $sql = "DELETE FROM tours WHERE tour_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}
?>