<?php
class HotelQuery extends BaseModel {

    public $hotel_name;
    public $address;
    public $rating;
    public function getAllHotel() {
        $sql = "SELECT * FROM hotels ORDER BY hotel_id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findHotel($id) {
        $sql = "SELECT * FROM hotels WHERE hotel_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function createHotel() {
        $sql = "INSERT INTO hotels (hotel_name, address, rating)
                VALUES (:hotel_name, :address, :rating)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':hotel_name', $this->hotel_name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':rating', $this->rating);
        return $stmt->execute();
    }
    public function updateHotel($id) {
        $sql = "UPDATE hotels SET 
                    hotel_name = :hotel_name,
                    address = :address,
                    rating = :rating
                WHERE hotel_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hotel_name', $this->hotel_name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function deleteHotel($id) {
        try {
            $sql = "DELETE FROM hotels WHERE hotel_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
