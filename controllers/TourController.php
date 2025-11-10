<?php
class TourController {
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
}
?>