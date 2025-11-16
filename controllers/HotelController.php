<?php
class HotelController
{
    private $hotelModel;

    public function __construct()
    {
        $this->hotelModel = new HotelQuery();
    }
    public function listHotel()
    {
        $hotel = $this->hotelModel->getAllHotel();
        require './views/Hotel/listHotel.php';
    }
    public function createHotel()
    {
        $err = [];
        $success = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (empty($_POST['hotel_name']) || empty($_POST['address']) || empty($_POST['rating'])) {
                $err['empty'] = "Vui lòng điền đầy đủ thông tin!";
            }

            if (!empty($_POST['rating']) && ($_POST['rating'] < 0 || $_POST['rating'] > 5)) {
                $err['rating'] = "Rating phải từ 0 đến 5.";
            }

            if (empty($err)) {
                $this->hotelModel->hotel_name = $_POST['hotel_name'];
                $this->hotelModel->address    = $_POST['address'];
                $this->hotelModel->rating     = $_POST['rating'];

                if ($this->hotelModel->createHotel()) {
                      echo "<script>
                        alert('Thêm hotel thành công!');
                        window.location.href='?action=admin-listHotel';
                    </script>";
                    exit;
                }
            }
        }

        require './views/Hotel/createHotel.php';
    }
    public function updateHotel()
    {
        $id = $_GET['id'] ?? null;
        $hotel = $this->hotelModel->findHotel($id);

        if (!$hotel) {
            echo "<script>alert('Hotel không tồn tại!'); window.location='?action=admin-listHotel';</script>";
            exit;
        }

        $err = [];
        $success = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (empty($_POST['hotel_name']) || empty($_POST['address']) || empty($_POST['rating'])) {
                $err['empty'] = "Vui lòng điền đầy đủ thông tin!";
            }

            if (!empty($_POST['rating']) && ($_POST['rating'] < 0 || $_POST['rating'] > 5)) {
                $err['rating'] = "Rating phải từ 0 đến 5.";
            }

            if (empty($err)) {
                $this->hotelModel->hotel_name = $_POST['hotel_name'];
                $this->hotelModel->address    = $_POST['address'];
                $this->hotelModel->rating     = $_POST['rating'];

                if ($this->hotelModel->updateHotel($id)) {
                    echo "<script>
                        alert('Cập nhật hotel thành công!');
                        window.location='?action=admin-listHotel';
                    </script>";
                    exit;
                }
            }
        }

        require './views/Hotel/updateHotel.php';
    }


    public function deleteHotel()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            if ($this->hotelModel->deleteHotel($id)) {
                echo "<script>
                    alert('Xóa hotel thành công!');
                    window.location='?action=admin-listHotel';
                </script>";
            } else {
                echo "<script>
                    alert('Không thể xóa hotel!');
                    window.location='?action=admin-listHotel';
                </script>";
            }
            exit;
        }
    }
}
?>
