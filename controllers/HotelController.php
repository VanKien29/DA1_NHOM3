<?php
class HotelController
{
    private $hotelQuery;

    function __construct()
    {
        $this->hotelQuery = new HotelQuery();
    }

    // ==== Danh sách Hotel ====
    public function listHotel()
    {
        $hotels = $this->hotelQuery->getAllHotel();
        require './views/Hotel/listHotel.php';
    }

    // ==== Thêm Hotel ====
    public function createHotel()
    {
        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (empty($_POST['service_name'])) {
    $err['service_name'] = "Tên Hotel / Dịch vụ không được để trống!";
}
if (empty($_POST['room_type'])) {
    $err['room_type'] = "Loại phòng không được để trống!";
}
if (empty($_POST['price_per_night'])) {
    $err['price_per_night'] = "Giá mỗi đêm không được để trống!";
} elseif ($_POST['price_per_night'] <= 0) {
    $err['price_per_night'] = "Giá phải lớn hơn 0!";
}
if (empty($_POST['description'])) {
    $err['description'] = "Mô tả không được để trống!";
}
if ($_FILES['hotel_image']['size'] <= 0) {
    $err['hotel_image'] = "Vui lòng chọn ảnh Hotel!";
}

            if (empty($err)) {
                $this->hotelQuery->service_name = $_POST['service_name'];
                $this->hotelQuery->room_type = $_POST['room_type'];
                $this->hotelQuery->price_per_night = $_POST['price_per_night'];
                $this->hotelQuery->description = $_POST['description'];
                
                 if(isset($_FILES["hotel_image"]) && $_FILES["hotel_image"]["size"] >0){
                    $this->hotelQuery->hotel_image = upload_file('image/HotelImages', $_FILES["hotel_image"]);
                }

                if ($this->hotelQuery->createHotel()) {
                    echo "<script>alert('Thêm Hotel thành công!'); 
                          window.location='?action=admin-listHotel'</script>";
                    exit;
                }
            }
        }

        require './views/Hotel/createHotel.php';
    }

    // ==== Cập nhật Hotel ====
    public function updateHotel()
    {
        if (!isset($_GET['id'])) {
            header("Location: ?action=admin-listHotel");
            exit;
        }

        $id = $_GET['id'];
        $hotel = $this->hotelQuery->findHotel($id);
        if (!$hotel) {
            header("Location: ?action=admin-listHotel");
            exit;
        }

        $err = [];

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (empty($_POST['service_name'])) {
    $err['service_name'] = "Tên Hotel / Dịch vụ không được để trống!";
}
if (empty($_POST['room_type'])) {
    $err['room_type'] = "Loại phòng không được để trống!";
}
if (empty($_POST['price_per_night'])) {
    $err['price_per_night'] = "Giá mỗi đêm không được để trống!";
} elseif ($_POST['price_per_night'] <= 0) {
    $err['price_per_night'] = "Giá phải lớn hơn 0!";
}
if (empty($_POST['description'])) {
    $err['description'] = "Mô tả không được để trống!";
}
if (empty($_FILES['image']['name']) || $_FILES['image']['size'] <= 0) {
    $err['hotel_image'] = "Vui lòng chọn ảnh Hotel!";
}



            if (empty($err)) {
                $this->hotelQuery->service_name = $_POST['service_name'];
                $this->hotelQuery->room_type = $_POST['room_type'];
                $this->hotelQuery->price_per_night = $_POST['price_per_night'];
                $this->hotelQuery->description = $_POST['description'];

                if ($_FILES['hotel_image']['size'] > 0) {
                    $this->hotelQuery->hotel_image = upload_file('image/HotelImages', $_FILES['hotel_image']);
                } else {
                    $this->hotelQuery->hotel_image = $hotel["hotel_image"];
                }

                if ($this->hotelQuery->updateHotel($id)) {
                    echo "<script>alert('Cập nhật Hotel thành công!'); 
                          window.location='?action=admin-listHotel'</script>";
                    exit;
                }
            }
        }

        require './views/Hotel/updateHotel.php';
    }

    // ==== Xóa Hotel ====
    public function deleteHotel()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->hotelQuery->deleteHotel($id)) {
                echo "<script>alert('Xóa thành công!'); 
                      window.location='?action=admin-listHotel'</script>";
            } else {
                echo "<script>alert('Không thể xóa vì Hotel đang được sử dụng trong Booking!'); 
                      window.location='?action=admin-listHotel'</script>";
            }
        }
        exit;
    }
}
?>