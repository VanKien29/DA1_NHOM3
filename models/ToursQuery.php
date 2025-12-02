<?php
class ToursQuery extends BaseModel
{
    public $tour_id;
    public $tour_name;
    public $description;
    public $price;
    public $category_id;
    public $status;
    public $category_name;
    public $tour_images;
    public $days;

    // ================== TOUR ==================

    public function getAllTours()
    {
        $sql = "SELECT t.*, c.category_name 
                FROM tours t
                INNER JOIN categories c ON t.category_id = c.category_id
                ORDER BY t.tour_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllToursWithCategory()
    {
        $sql = "SELECT t.*, c.category_name
                FROM tours t
                LEFT JOIN categories c ON t.category_id = c.category_id
                ORDER BY t.tour_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findTour($id)
    {
        $sql = "SELECT t.*, c.category_name 
                FROM tours t
                INNER JOIN categories c ON t.category_id = c.category_id
                WHERE t.tour_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchTours($keyword)
    {
        $sql = "SELECT t.*, c.category_name 
                FROM tours t
                INNER JOIN categories c ON t.category_id = c.category_id
                WHERE LOWER(t.tour_name) LIKE :keyword
                ORDER BY t.tour_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $like = '%' . strtolower($keyword) . '%';
        $stmt->bindParam(':keyword', $like);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTour()
    {
        // Chú ý: bảng tours phải có cột days
        $sql = "INSERT INTO tours (tour_name, description, price, days, category_id, tour_images)
                VALUES (:tour_name, :description, :price, :days, :category_id, :tour_images)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':days', $this->days, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':tour_images', $this->tour_images);
        $stmt->execute();
        // trả về tour_id mới tạo để dùng cho lịch trình
        return $this->pdo->lastInsertId();
    }

    public function updateTour()
    {
        $sql = "UPDATE tours SET 
                    tour_name   = :tour_name,
                    description = :description,
                    price       = :price,
                    days        = :days,
                    category_id = :category_id,
                    tour_images = :tour_images
                WHERE tour_id = :tour_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':days', $this->days, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':tour_images', $this->tour_images);
        return $stmt->execute();
    }

    public function deleteTour($id)
    {
        try {
            // Xoá lịch trình trước (nếu có)
            $this->deleteSchedulesByTour($id);

            $sql = "DELETE FROM tours WHERE tour_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                return false;
            }
            throw $e;
        }
    }

    // ================== LỊCH TRÌNH TOUR ==================

    public function getTourSchedules($tour_id)
    {
        $sql = "SELECT * 
                FROM tour_schedules
                WHERE tour_id = :tour_id
                ORDER BY day_number ASC, tour_schedule_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteSchedulesByTour($tour_id)
    {
        $sql = "DELETE FROM tour_schedules WHERE tour_id = :tour_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function insertSchedule($tour_id, $day_number, $title, $description)
    {
        $sql = "INSERT INTO tour_schedules (tour_id, day_number, title, description)
                VALUES (:tour_id, :day_number, :title, :description)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
        $stmt->bindParam(':day_number', $day_number, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }
}
?>