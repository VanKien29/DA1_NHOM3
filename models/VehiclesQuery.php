<?php
class VehiclesQuery extends BaseModel
{
    // Map đúng với bảng vehicles
    public $service_name;
    public $seat;
    public $price_per_day;
    public $description;

    public $driver_name;
    public $driver_phone;
    public $license_plate;

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
        $sql = "INSERT INTO vehicles (service_name, driver_name, driver_phone, license_plate, seat, price_per_day, description)
                VALUES (:service_name, :driver_name, :driver_phone, :license_plate, :seat, :price_per_day, :description)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':service_name', $this->service_name);
        $stmt->bindParam(':driver_name', $this->driver_name);
        $stmt->bindParam(':driver_phone', $this->driver_phone);
        $stmt->bindParam(':license_plate', $this->license_plate);
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
                    driver_name = :driver_name,
                    driver_phone = :driver_phone,
                    license_plate = :license_plate,
                    seat = :seat,
                    price_per_day = :price_per_day,
                    description = :description
                WHERE vehicle_service_id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':service_name', $this->service_name);
        $stmt->bindParam(':driver_name', $this->driver_name);
        $stmt->bindParam(':driver_phone', $this->driver_phone);
        $stmt->bindParam(':license_plate', $this->license_plate);
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