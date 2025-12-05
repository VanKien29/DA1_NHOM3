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
        $sql = "INSERT INTO tours (tour_name, description, price_adult, price_child, price_vip, days, category_id, tour_images)
        VALUES (:tour_name, :description, :price_adult, :price_child, :price_vip, :days, :category_id, :tour_images)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price_adult', $this->price_adult);
        $stmt->bindParam(':price_child', $this->price_child);
        $stmt->bindParam(':price_vip', $this->price_vip);
        $stmt->bindParam(':days', $this->days, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':tour_images', $this->tour_images);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function updateTour()
    {
        $sql = "UPDATE tours SET 
                    tour_name   = :tour_name,
                    description = :description,
                    price_adult       = :price_adult,
                    price_child       = :price_child,
                    price_vip         = :price_vip,
                    days        = :days,
                    category_id = :category_id,
                    tour_images = :tour_images
                WHERE tour_id = :tour_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price_adult', $this->price_adult);
        $stmt->bindParam(':price_child', $this->price_child);
        $stmt->bindParam(':price_vip', $this->price_vip);
        $stmt->bindParam(':days', $this->days, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':tour_images', $this->tour_images);
        return $stmt->execute();
    }

    public function deleteTour($id)
    {
        try {
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

    public function getTourSchedule($tour_id) {
        $sql = "SELECT * FROM tour_schedules WHERE tour_id = ? ORDER BY day_number ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>