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
            if (empty($_POST['tour_name']) || empty($_POST['price']) || empty($_POST['tour_images'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (empty($_POST['price']) || $_POST['price'] < 0) {
                $err['price'] = "Giá tour không hợp lệ.";
            }
            if (empty($err)) {
                $this->tourQuery->tour_name = $_POST['tour_name'];
                $this->tourQuery->description = $_POST['description'];
                $this->tourQuery->price = $_POST['price'];
                $this->tourQuery->category_id = $_POST['category_id'];
                $this->tourQuery->status = $_POST['status'];
                $this->tourQuery->tour_images = $_FILES['tour_images'];
                if (isset($_FILES['tour_images']) && $_FILES['tour_images']['size'] > 0) {
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
            if (empty($_POST['tour_name']) || empty($_POST['price'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (empty($_POST['price']) || $_POST['price'] < 0) {
                $err['price'] = "Giá tour không hợp lệ.";
            }
            if (empty($err)) {
                $this->tourQuery->tour_id = $id;
                $this->tourQuery->tour_name = $_POST['tour_name'];
                $this->tourQuery->description = $_POST['description'];
                $this->tourQuery->price = $_POST['price'];
                $this->tourQuery->category_id = $_POST['category_id'];
                $this->tourQuery->status = $_POST['status'];
                // Xử lý ảnh
                if ($_FILES['tour_images']['size'] > 0) {
                    $this->tourQuery->tour_images = upload_file('image/TourImages', $_FILES['tour_images']);
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