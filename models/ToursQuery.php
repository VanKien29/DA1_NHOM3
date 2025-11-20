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
    public function createTour()
    {
        $sql = "INSERT INTO tours (tour_name, description, price, category_id, tour_images)
                VALUES (:tour_name, :description, :price, :category_id, :tour_images)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':tour_images', $this->tour_images);
        return $stmt->execute();
    }
    public function updateTour(){
        $sql = "UPDATE tours SET 
                tour_name = :tour_name,
                description = :description,
                price = :price,
                category_id = :category_id,
                tour_images = :tour_images
            WHERE tour_id = :tour_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':tour_name', $this->tour_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':tour_images', $this->tour_images);
        return $stmt->execute();
    }

    public function deleteTour($id)
    {
        try {
            $sql = "DELETE FROM tours WHERE tour_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                return false;
            }
        }
    }
}
?>