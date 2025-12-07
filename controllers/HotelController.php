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

    public function createHotel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];

            if (empty($_POST['service_name']) || strlen($_POST['service_name']) < 3)
                $err['service_name'] = "Tên Hotel không hợp lệ";

            if (empty($_POST['hotel_manager']))
                $err['hotel_manager'] = "Chủ khách sạn không được để trống";

            if (empty($_POST['hotel_manager_phone']) || !preg_match('/^(0|\+84)[0-9]{8,11}$/', $_POST['hotel_manager_phone']))
                $err['hotel_manager_phone'] = "Số điện thoại không hợp lệ";

            if (empty($_POST['price_per_night']) || $_POST['price_per_night'] <= 0)
                $err['price_per_night'] = "Giá mỗi đêm không hợp lệ";

            if (empty($_POST['description']) || strlen($_POST['description']) < 10)
                $err['description'] = "Mô tả không hợp lệ";

            if ($_FILES['hotel_image']['size'] <= 0)
                $err['hotel_image'] = "Ảnh Hotel không được để trống";
            else {
                $ext = strtolower(pathinfo($_FILES['hotel_image']['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg','jpeg','png','webp'])) $err['hotel_image'] = "Sai định dạng ảnh";
                if ($_FILES['hotel_image']['size'] > 5*1024*1024) $err['hotel_image'] = "Ảnh vượt quá 5MB";
            }

            if (empty($err)) {
                $this->hotelQuery->service_name = $_POST['service_name'];
                $this->hotelQuery->hotel_manager = $_POST['hotel_manager'];
                $this->hotelQuery->hotel_manager_phone = $_POST['hotel_manager_phone'];
                $this->hotelQuery->price_per_night = $_POST['price_per_night'];
                $this->hotelQuery->description = $_POST['description'];
                $this->hotelQuery->hotel_image = upload_file('image/HotelImages', $_FILES["hotel_image"]);
                if ($this->hotelQuery->createHotel()) {
                    echo "<script>alert('Thêm Hotel thành công!');window.location='?action=admin-listHotel'</script>";
                    exit;
                }
            }
        }
        require './views/Hotel/createHotel.php';
    }


    public function updateHotel()
    {
        $id = $_GET['id'];
        $hotel = $this->hotelQuery->findHotel($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];

            if (empty($_POST['service_name']) || strlen($_POST['service_name']) < 3)
                $err['service_name'] = "Tên Hotel không hợp lệ";

            if (empty($_POST['hotel_manager']))
                $err['hotel_manager'] = "Chủ khách sạn không được để trống";

            if (empty($_POST['hotel_manager_phone']) || !preg_match('/^(0|\+84)[0-9]{8,11}$/', $_POST['hotel_manager_phone']))
                $err['hotel_manager_phone'] = "Số điện thoại không hợp lệ";

            if (empty($_POST['price_per_night']) || $_POST['price_per_night'] <= 0)
                $err['price_per_night'] = "Giá mỗi đêm không hợp lệ";

            if (empty($_POST['description']) || strlen($_POST['description']) < 10)
                $err['description'] = "Mô tả không hợp lệ";

            $newImg = $hotel['hotel_image'];
            if ($_FILES['hotel_image']['size'] > 0) {
                $ext = strtolower(pathinfo($_FILES['hotel_image']['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg','jpeg','png','webp'])) $err['hotel_image'] = "Sai định dạng ảnh";
                elseif ($_FILES['hotel_image']['size'] > 5*1024*1024) $err['hotel_image'] = "Ảnh vượt quá 5MB";
                else $newImg = upload_file('image/HotelImages', $_FILES['hotel_image']);
            }

            if (empty($err)) {
                $this->hotelQuery->service_name = $_POST['service_name'];
                $this->hotelQuery->hotel_manager = $_POST['hotel_manager'];
                $this->hotelQuery->hotel_manager_phone = $_POST['hotel_manager_phone'];
                $this->hotelQuery->price_per_night = $_POST['price_per_night'];
                $this->hotelQuery->description = $_POST['description'];
                $this->hotelQuery->hotel_image = $newImg;

                if ($this->hotelQuery->updateHotel($id)) {
                    echo "<script>alert('Cập nhật Hotel thành công!');window.location='?action=admin-listHotel'</script>";
                    exit;
                }
            }
        }
        require './views/Hotel/updateHotel.php';
    }

}
?>