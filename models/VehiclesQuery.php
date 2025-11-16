<?php
class VehiclesQuery extends BaseModel {

    public $plate_number;
    public $supplier_id;
    public $type;
    public $capacity;

    // ================= LẤY TẤT CẢ VEHICLES =================
    public function getAllVehicles() {
        $sql = "SELECT * FROM vehicles ORDER BY vehicle_id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================= TÌM VEHICLE THEO ID =================
    public function findVehicles($id) {
        $sql = "SELECT * FROM vehicles WHERE vehicle_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ================= TẠO MỚI VEHICLE =================
    public function createVehicles() {
        $sql = "INSERT INTO vehicles (plate_number, supplier_id, type, capacity)
                VALUES (:plate_number, :supplier_id, :type, :capacity)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':plate_number', $this->plate_number);
        $stmt->bindParam(':supplier_id', $this->supplier_id);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':capacity', $this->capacity);

        return $stmt->execute();
    }

    // ================= CẬP NHẬT VEHICLE =================
    public function updateVehicles($id) {
        $sql = "UPDATE vehicles SET 
                    plate_number = :plate_number,
                    supplier_id = :supplier_id,
                    type = :type,
                    capacity = :capacity
                WHERE vehicle_id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':plate_number', $this->plate_number);
        $stmt->bindParam(':supplier_id', $this->supplier_id);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':capacity', $this->capacity);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // ================= XÓA VEHICLE =================
    public function deleteVehicles($id) {
        try {
            $sql = "DELETE FROM vehicles WHERE vehicle_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                return false;
            }
            throw $e;
        }
    }
}
?>
