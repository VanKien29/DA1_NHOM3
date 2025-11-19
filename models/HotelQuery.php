<?php
class HotelQuery extends BaseModel
{
    // Map đúng với bảng hotels
    public $service_name;
    public $room_type;
    public $price_per_night;
    public $description;

    // Lấy tất cả hotel
    public function getAllHotel()
    {
        $sql = "SELECT * FROM hotels ORDER BY hotel_service_id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm hotel theo id
    public function findHotel($id)
    {
        $sql = "SELECT * FROM hotels WHERE hotel_service_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm hotel mới
    public function createHotel()
    {
        $sql = "INSERT INTO hotels (service_name, room_type, price_per_night, description)
                VALUES (:service_name, :room_type, :price_per_night, :description)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':service_name', $this->service_name);
        $stmt->bindParam(':room_type', $this->room_type);
        $stmt->bindParam(':price_per_night', $this->price_per_night);
        $stmt->bindParam(':description', $this->description);

        return $stmt->execute();
    }

    // Cập nhật hotel
    public function updateHotel($id)
    {
        $sql = "UPDATE hotels SET
                    service_name = :service_name,
                    room_type = :room_type,
                    price_per_night = :price_per_night,
                    description = :description
                WHERE hotel_service_id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':service_name', $this->service_name);
        $stmt->bindParam(':room_type', $this->room_type);
        $stmt->bindParam(':price_per_night', $this->price_per_night);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Xoá hotel
    public function deleteHotel($id)
    {
        try {
            $sql = "DELETE FROM hotels WHERE hotel_service_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() === "23000") {
                return false;
            }
            throw $e;
        }
    }
}
?>