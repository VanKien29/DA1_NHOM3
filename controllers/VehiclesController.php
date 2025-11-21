<?php
class VehiclesController
{
    private $vehiclesQuery;

    function __construct()
    {
        $this->vehiclesQuery = new VehiclesQuery();
    }

    // ==== Danh sách Vehicles ====
    public function listVehicles()
    {
        $vehicles = $this->vehiclesQuery->getAllVehicles();
        require './views/Vehicles/listVehicles.php';
    }

    // ==== Thêm Vehicles ====
    public function createVehicles()
    {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $err = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['service_name'])) {
        $err['service_name'] = "Tên dịch vụ không được để trống!";
    }

    if (empty($_POST['seat'])) {
        $err['seat'] = "Vui lòng nhập số chỗ!";
    } elseif ($_POST['seat'] <= 0) {
        $err['seat'] = "Số chỗ phải lớn hơn 0!";
    }
    if (empty($_POST['price_per_day'])) {
        $err['price_per_day'] = "Vui lòng nhập giá!";
    } elseif ($_POST['price_per_day'] <= 0) {
        $err['price_per_day'] = "Giá phải lớn hơn 0!";
    }
    if (empty($_POST['description'])) {
        $err['description'] = "Mô tả không được để trống!";
    }
    if (empty($err)) {
    }
}


            if (empty($err)) {
                $this->vehiclesQuery->service_name = $_POST['service_name'];
                $this->vehiclesQuery->seat = $_POST['seat'];
                $this->vehiclesQuery->price_per_day = $_POST['price_per_day'];
                $this->vehiclesQuery->description = $_POST['description'];

                if ($this->vehiclesQuery->createVehicles()) {
                    echo "<script>alert('Thêm Phương tiện thành công!'); 
                          window.location='?action=admin-listVehicles'</script>";
                    exit;
                }
            }
        }

        require './views/Vehicles/createVehicles.php';
    }

    // ==== Cập nhật Vehicles ====
    public function updateVehicles()
    {
        if (!isset($_GET['id'])) {
            header("Location: ?action=admin-listVehicles");
            exit;
        }

        $id = $_GET['id'];
        $vehicles = $this->vehiclesQuery->findVehicles($id);
        if (!$vehicles) {
            header("Location: ?action=admin-listVehicles");
            exit;
        }

        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['service_name']) || empty($_POST['seat']) ||
                empty($_POST['price_per_day']) || empty($_POST['description'])) {

                $err['empty'] = "Vui lòng nhập đầy đủ thông tin!";
            } elseif ($_POST['seat'] <= 0) {
                $err['seat'] = "Số chỗ phải lớn hơn 0!";
            } elseif ($_POST['price_per_day'] <= 0) {
                $err['price_per_day'] = "Giá phải lớn hơn 0!";
            }

            if (empty($err)) {
                $this->vehiclesQuery->service_name = $_POST['service_name'];
                $this->vehiclesQuery->seat = $_POST['seat'];
                $this->vehiclesQuery->price_per_day = $_POST['price_per_day'];
                $this->vehiclesQuery->description = $_POST['description'];

                if ($this->vehiclesQuery->updateVehicles($id)) {
                    echo "<script>alert('Cập nhật thành công!'); 
                          window.location='?action=admin-listVehicles'</script>";
                    exit;
                }
            }
        }

        require './views/Vehicles/updateVehicles.php';
    }

    // ==== Xóa Vehicles ====
    public function deleteVehicles()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->vehiclesQuery->deleteVehicles($id)) {
                echo "<script>alert('Xóa thành công!'); 
                      window.location='?action=admin-listVehicles'</script>";
            } else {
                echo "<script>alert('Không thể xóa vì phương tiện đang được sử dụng trong Booking!'); 
                      window.location='?action=admin-listVehicles'</script>";
            }
        }
        exit;
    }
}
?>