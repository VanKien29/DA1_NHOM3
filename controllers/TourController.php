<?php
class TourController
{
    private $tourQuery;
    private $categoryModel;

    public function __construct()
    {
        $this->tourQuery = new ToursQuery();
        $this->categoryModel = new CategoryQuery();
    }

    // ===== Danh sách tour =====
    public function listTours()
    {
        $tours = $this->tourQuery->getAllToursWithCategory();
        require './views/Tour/listTour.php';
    }

    public function searchTours()
    {
        $keyword = $_GET['keyword'] ?? '';
        $tours = $this->tourQuery->searchTours($keyword);
        require './views/Tour/listTour.php';
    }

    // ===== Thêm tour =====
    public function createTours()
    {
        $categories = $this->categoryModel->getAllCategories();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['tour_name']) ) {
                $err['tour_name'] = "Tên tour khong được để trống!";
            }
            if ($_FILES['tour_images']['size'] <= 0 ) {
                $err['tour_images'] = "Thêm Ảnh tour!";
            }
            if (empty($_POST['price']) || $_POST['price'] < 0) {
                $err['price'] = "Giá tour không hợp lệ.";
            }
            $days = isset($_POST['duration_days']) ? (int)$_POST['duration_days'] : 0;
            $nights = isset($_POST['duration_nights']) ? (int)$_POST['duration_nights'] : 0;
            if ($days <= 0) {
            $err['duration_days'] = "Số ngày phải lớn hơn 0.";
            } 
            else if ($days !== $nights + 1) {
            $err['duration_time'] = "Số ngày phải bằng số đêm + 1.";
            }
            if ($nights < 0) {
            $err['duration_nights'] = "Số đêm không được âm.";
            }


            if (empty($err)) {
                $this->tourQuery->tour_name = $_POST['tour_name'];
                $this->tourQuery->description = $_POST['description'];
                $this->tourQuery->price = $_POST['price'];
                $this->tourQuery->category_id = $_POST['category_id'];
                $this->tourQuery->tour_images = $_FILES['tour_images'];
                $this->tourQuery->duration_days = $_POST['duration_days'];
                $this->tourQuery->duration_nights = $_POST['duration_nights'];

                if(isset($_FILES["tour_images"]) && $_FILES["tour_images"]["size"] >0){
                    $this->tourQuery->tour_images = upload_file('image/TourImages', $_FILES["tour_images"]);
                }

                if ($this->tourQuery->createTour()) {
                    echo "<script>
                        alert('Thêm tour thành công!');
                        window.location.href='?action=admin-listTours';
                    </script>";
                    exit;
                }
            }
        }
        require './views/Tour/createTour.php';
    }

    // ===== Cập nhật tour =====
    public function updateTours($id)
    {
        $categories = $this->categoryModel->getAllCategories();
        $tour = $this->tourQuery->findTour($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['tour_name']) ) {
                $err['tour_name'] = "Tên tour khong được để trống!";
            }
            if ($_FILES['tour_images']['size'] <= 0 ) {
                $err['tour_images'] = "Thêm Ảnh tour!";
            }
            if (empty($_POST['price']) || $_POST['price'] < 0) {
                $err['price'] = "Giá tour không hợp lệ.";
            }
            $days = isset($_POST['duration_days']) ? (int)$_POST['duration_days'] : 0;
            $nights = isset($_POST['duration_nights']) ? (int)$_POST['duration_nights'] : 0;
            if ($days <= 0) {
                $err['duration_days'] = "Số ngày phải lớn hơn 0.";
            } 
            else if ($days !== $nights + 1) {
                $err['duration_time'] = "Số ngày phải bằng số đêm + 1.";
            }
            if ($nights < 0) {
                $err['duration_nights'] = "Số đêm không được âm.";
            }

            if (empty($err)) {
                $this->tourQuery->tour_id = $id;
                $this->tourQuery->tour_name = $_POST['tour_name'];
                $this->tourQuery->description = $_POST['description'];
                $this->tourQuery->price = $_POST['price'];
                $this->tourQuery->category_id = $_POST['category_id'];
                $this->tourQuery->duration_days = $_POST['duration_days'];
                $this->tourQuery->duration_nights = $_POST['duration_nights'];
                
                if ($_FILES['tour_images']['size'] > 0) {
                    $this->tourQuery->tour_images = upload_file('image/TourImages', $_FILES['tour_images']);
                } else {
                    $this->tourQuery->tour_images = $tour["tour_images"];
                }

                if ($this->tourQuery->updateTour()) {
                    echo "<script>
                        alert('Cập nhật tour thành công!');
                        window.location.href='?action=admin-listTours';
                    </script>";
                    exit;
                }
            }
        }
        require './views/Tour/updateTour.php';
    }

    // ===== Xóa tour =====
    public function deleteTours($id)
    {
        if ($id) {
            if ($this->tourQuery->deleteTour($id)) {
                echo "<script>
                    alert('Xóa tour thành công!');
                    window.location.href='?action=admin-listTours';
            </script>";
                exit;
            } else {
                echo "<script>
                    alert('Không thể xoá tour vì đang có khách hàng thuộc tour này!');
                    window.location.href='?action=admin-listTours';
            </script>";
                exit;
            }
        }
    }
}
?>