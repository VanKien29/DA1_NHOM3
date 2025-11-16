<?php
class VehiclesController
{
    private $vehiclesModel;

    public function __construct()
    {
        $this->vehiclesModel = new VehiclesQuery();
    }
    public function listVehicles()
    {
        $vehicles = $this->vehiclesModel->getAllVehicles();
        require './views/Vehicles/listVehicles.php';
    }
    public function createVehicles()
    {
        $err = [];
        $success = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (empty($_POST['plate_number']) || empty($_POST['supplier_id']) ||
                empty($_POST['type']) || empty($_POST['capacity'])) {
                $err['empty'] = "Vui lòng điền đầy đủ thông tin!";
            }

            if (!empty($_POST['capacity']) && $_POST['capacity'] <= 0) {
                $err['capacity'] = "Số chỗ phải lớn hơn 0!";
            }

            if (empty($err)) {
                $this->vehiclesModel->plate_number = $_POST['plate_number'];
                $this->vehiclesModel->supplier_id  = $_POST['supplier_id'];
                $this->vehiclesModel->type         = $_POST['type'];
                $this->vehiclesModel->capacity     = $_POST['capacity'];

                if ($this->vehiclesModel->createVehicles()) {
                    $success = "Thêm phương tiện thành công!";
                } else {
                    $err['query'] = "Lỗi thêm dữ liệu!";
                }
            }
        }

        require './views/Vehicles/createVehicles.php';
    }
    public function updateVehicles()
    {
        $id = $_GET['id'] ?? null;
        $vehicles = $this->vehiclesModel->findVehicles($id);

        if (!$vehicles) {
            echo "<script>alert('Xe không tồn tại!'); window.location='?action=admin-listVehicles';</script>";
            exit;
        }

        $err = [];
        $success = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (empty($_POST['plate_number']) || empty($_POST['supplier_id']) ||
                empty($_POST['type']) || empty($_POST['capacity'])) {
                $err['empty'] = "Vui lòng điền đầy đủ thông tin!";
            }

            if (!empty($_POST['capacity']) && $_POST['capacity'] <= 0) {
                $err['capacity'] = "Số chỗ phải lớn hơn 0!";
            }

            if (empty($err)) {
                $this->vehiclesModel->plate_number = $_POST['plate_number'];
                $this->vehiclesModel->supplier_id  = $_POST['supplier_id'];
                $this->vehiclesModel->type         = $_POST['type'];
                $this->vehiclesModel->capacity     = $_POST['capacity'];

                if ($this->vehiclesModel->updateVehicles($id)) {
                    echo "<script>
                        alert('Cập nhật thành công!');
                        window.location='?action=admin-listVehicles';
                    </script>";
                    exit;
                }
            }
        }

        require './views/Vehicles/updateVehicles.php';
    }

    // ================= DELETE =================
    public function deleteVehicles()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            if ($this->vehiclesModel->deleteVehicles($id)) {
                echo "<script>
                    alert('Xóa phương tiện thành công!');
                    window.location='?action=admin-listVehicles';
                </script>";
            } else {
                echo "<script>
                    alert('Không thể xóa phương tiện!');
                    window.location='?action=admin-listVehicles';
                </script>";
            }
            exit;
        }
    }
}
?>
