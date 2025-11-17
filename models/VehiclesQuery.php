<?php
class VehiclesQuery extends BaseModel
{
    // Map đúng với bảng vehicles
    public $service_name;
    public $seat;
    public $price_per_day;
    public $description;

    // Lấy tất cả vehicles
    public function getAllVehicles()
    {
        $sql = "SELECT * FROM vehicles ORDER BY vehicle_service_id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm vehicle theo id
    public function findVehicles($id)
    {
        $sql = "SELECT * FROM vehicles WHERE vehicle_service_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm vehicle
    public function createVehicles()
    {
        $sql = "INSERT INTO vehicles (service_name, seat, price_per_day, description)
                VALUES (:service_name, :seat, :price_per_day, :description)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':service_name', $this->service_name);
        $stmt->bindParam(':seat', $this->seat);
        $stmt->bindParam(':price_per_day', $this->price_per_day);
        $stmt->bindParam(':description', $this->description);

        return $stmt->execute();
    }

    // Cập nhật vehicle
    public function updateVehicles($id)
    {
        $sql = "UPDATE vehicles SET
                    service_name = :service_name,
                    seat = :seat,
                    price_per_day = :price_per_day,
                    description = :description
                WHERE vehicle_service_id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':service_name', $this->service_name);
        $stmt->bindParam(':seat', $this->seat);
        $stmt->bindParam(':price_per_day', $this->price_per_day);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Xoá vehicle
    public function deleteVehicles($id)
    {
        try {
            $sql = "DELETE FROM vehicles WHERE vehicle_service_id = :id";
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