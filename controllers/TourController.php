<?php
class TourController {
    public $categoriesModel;
    public function __construct(){
       $this->categoriesModel = new Categorys();  
    }
    // ====== Phương thức hiển thị danh sách tour ======
    public function listTours() {
        $toursQuery = new ToursQuery();
        $tours = $toursQuery->getAllTours();

        // Phân trang (giả sử mỗi trang hiển thị 10 tour)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $totalTours = count($tours);
        $totalPages = ceil($totalTours / $perPage);
        $start = ($page - 1) * $perPage;
        $tours = array_slice($tours, $start, $perPage);

        require_once './views/admin/Tour/listTour.php';
    }
    public function createTours() {
        $toursQuery = new ToursQuery();
        // gọi model danh mục qua $this
        $categories = $this->categoriesModel->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $toursQuery->tour_name = $_POST['tour_name'];
            $toursQuery->description = $_POST['description'];
            $toursQuery->price = $_POST['price'];
            $toursQuery->category_id = $_POST['category_id'];
            $toursQuery->start_date = $_POST['start_date'];
            $toursQuery->end_date = $_POST['end_date'];
            $toursQuery->status = $_POST['status'];

            $toursQuery->createTour();
            header("Location: ?action=admin-listTours");
            exit;
        }

        require './views/admin/Tour/createTour.php';
    }
    public function updateTours() {
        $toursQuery = new ToursQuery();
        $categories = $this->categoriesModel->getAllCategories();

        // Lấy id tour cần sửa
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?action=admin-listTours");
            exit;
        }

        // Lấy dữ liệu tour cũ để đổ lên form
        $tour = $toursQuery->findTour($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $toursQuery->tour_id = $id;
            $toursQuery->tour_name = $_POST['tour_name'];
            $toursQuery->description = $_POST['description'];
            $toursQuery->price = $_POST['price'];
            $toursQuery->category_id = $_POST['category_id'];
            $toursQuery->start_date = $_POST['start_date'];
            $toursQuery->end_date = $_POST['end_date'];
            $toursQuery->status = $_POST['status'];

            $toursQuery->updateTour();
            header("Location: ?action=admin-listTours");
            exit;
        }

        require './views/admin/Tour/updateTour.php';
    }

    public function deleteTour() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $toursQuery = new ToursQuery();
            $toursQuery->deleteTour($id);
        }
        header("Location: ?action=admin-listTours");
        exit;
    }
}
?>