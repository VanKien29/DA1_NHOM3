<?php
class TourController {
    private $tourQuery;
    private $categoryModel;

    public function __construct() {
        $this->tourQuery = new ToursQuery();
        $this->categoryModel = new Categorys();
    }

    // ===== Danh sách tour =====
    public function listTours() {
        // ✅ Lấy dữ liệu từ bảng tours, không phải categories
        $tours = $this->tourQuery->getAllToursWithCategory();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $totalTours = count($tours);
        $totalPages = ceil($totalTours / $perPage);
        $start = ($page - 1) * $perPage;
        $tours = array_slice($tours, $start, $perPage);

        require './views/Tour/listTour.php';
    }

    // ===== Thêm tour =====
    public function createTours() {
        $categories = $this->categoryModel->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tourQuery->tour_name = $_POST['tour_name'];
            $this->tourQuery->description = $_POST['description'];
            $this->tourQuery->price = $_POST['price'];
            $this->tourQuery->category_id = $_POST['category_id'];
            $this->tourQuery->start_date = $_POST['start_date'];
            $this->tourQuery->end_date = $_POST['end_date'];
            $this->tourQuery->status = $_POST['status'];

            $this->tourQuery->createTour();
            header("Location: ?action=admin-listTours");
            exit;
        }

        require './views/Tour/createTour.php';
    }

    // ===== Cập nhật tour =====
    public function updateTours() {
        $categories = $this->categoryModel->getAllCategories();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?action=admin-listTours");
            exit;
        }

        $tour = $this->tourQuery->findTour($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tourQuery->tour_id = $id;
            $this->tourQuery->tour_name = $_POST['tour_name'];
            $this->tourQuery->description = $_POST['description'];
            $this->tourQuery->price = $_POST['price'];
            $this->tourQuery->category_id = $_POST['category_id'];
            $this->tourQuery->start_date = $_POST['start_date'];
            $this->tourQuery->end_date = $_POST['end_date'];
            $this->tourQuery->status = $_POST['status'];

            $this->tourQuery->updateTour();
            header("Location: ?action=admin-listTours");
            exit;
        }

        require './views/Tour/updateTour.php';
    }

    // ===== Xóa tour =====
    public function deleteTours() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->tourQuery->deleteTour($id);
        }
        header("Location: ?action=admin-listTours");
        exit;
    }
}
?>