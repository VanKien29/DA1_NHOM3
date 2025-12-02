<?php
class TourController
{
    private $tourQuery;
    private $categoryModel;

    public function __construct()
    {
        $this->tourQuery     = new ToursQuery();
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
        $tours   = $this->tourQuery->searchTours($keyword);
        require './views/Tour/listTour.php';
    }

    // ===== Xem chi tiết tour + lịch trình =====
    public function detailTour($id)
    {
        $tour = $this->tourQuery->findTour($id);
        if (!$tour) {
            echo "<script>alert('Tour không tồn tại'); window.location.href='?action=admin-listTours';</script>";
            exit;
        }

        $schedules  = $this->tourQuery->getTourSchedules($id);
        require './views/Tour/detailTour.php';
    }

    // ===== Thêm tour (2 STEP: thông tin -> lịch trình) =====
    public function createTours()
    {
        $categories   = $this->categoryModel->getAllCategories();
        $current_step = isset($_POST['current_step']) ? (int)$_POST['current_step'] : 1;

        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Quay lại
            if (!empty($_POST['prev_step'])) {
                $current_step = (int)$_POST['prev_step'];
            } else {

                // ---------- STEP 1: thông tin tour ----------
                if ($current_step === 1 && isset($_POST['next_1'])) {
                    $tour_name   = trim($_POST['tour_name'] ?? '');
                    $description = $_POST['description'] ?? '';
                    $price       = $_POST['price'] ?? '';
                    $category_id = $_POST['category_id'] ?? '';
                    $days        = (int)($_POST['days'] ?? 0);

                    if ($tour_name === '') {
                        $err['tour_name'] = "Tên tour không được để trống!";
                    }
                    if ($price === '' || $price < 0) {
                        $err['price'] = "Giá tour không hợp lệ.";
                    }
                    if ($days <= 0) {
                        $err['days'] = "Số ngày tour phải lớn hơn 0.";
                    }
                    if ($_FILES['tour_images']['size'] <= 0) {
                        $err['tour_images'] = "Ảnh tour không được để trống!";
                    }

                    if (empty($err)) {
                        // Upload ảnh 1 lần tại step 1
                        $tour_images = upload_file('image/TourImages', $_FILES["tour_images"]);

                        // Lưu lại vào $_POST để Step 2 dùng hidden field
                        $_POST['tour_images_saved'] = $tour_images;

                        $current_step = 2;
                    }
                }

                // ---------- STEP 2: lịch trình ----------
                if ($current_step === 2 && isset($_POST['final_submit'])) {
                    // Lấy lại toàn bộ dữ liệu tour từ hidden
                    $tour_name   = trim($_POST['tour_name'] ?? '');
                    $description = $_POST['description'] ?? '';
                    $price       = $_POST['price'] ?? 0;
                    $category_id = $_POST['category_id'] ?? '';
                    $days        = (int)($_POST['days'] ?? 0);
                    $tour_images = $_POST['tour_images_saved'] ?? '';

                    $day_numbers = $_POST['day_number'] ?? [];
                    $titles      = $_POST['schedule_title'] ?? [];
                    $descs       = $_POST['schedule_description'] ?? [];

                    if ($tour_name === '' || $price === '' || $days <= 0 || $tour_images === '') {
                        $err['empty'] = "Thiếu dữ liệu tour, vui lòng kiểm tra lại.";
                    }

                    // có thể thêm validate lịch trình: ít nhất 1 ngày có title/desc

                    if (empty($err)) {
                        // Gán property
                        $this->tourQuery->tour_name   = $tour_name;
                        $this->tourQuery->description = $description;
                        $this->tourQuery->price       = $price;
                        $this->tourQuery->category_id = $category_id;
                        $this->tourQuery->tour_images = $tour_images;
                        $this->tourQuery->days        = $days;

                        // Tạo tour
                        $tour_id = $this->tourQuery->createTour();

                        // Thêm lịch trình
                        foreach ($day_numbers as $idx => $d) {
                            $d = (int)$d;
                            $title = trim($titles[$idx] ?? '');
                            $desc  = trim($descs[$idx] ?? '');

                            // Cho phép bỏ trống 1 vài ngày, tuỳ anh; ở đây nếu cả title & desc rỗng thì bỏ qua
                            if ($title === '' && $desc === '') continue;

                            $this->tourQuery->insertSchedule($tour_id, $d, $title, $desc);
                        }

                        echo "<script>
                            alert('Thêm tour thành công!');
                            window.location.href='?action=admin-listTours';
                        </script>";
                        exit;
                    } else {
                        $current_step = 2;
                    }
                }
            }
        }

        require './views/Tour/createTour.php';
    }

    // ===== Cập nhật tour (2 STEP) =====
    public function updateTours($id)
    {
        $categories   = $this->categoryModel->getAllCategories();
        $tour         = $this->tourQuery->findTour($id);

        if (!$tour) {
            echo "<script>alert('Tour không tồn tại'); window.location.href='?action=admin-listTours';</script>";
            exit;
        }

        $schedules    = $this->tourQuery->getTourSchedules($id);
        $current_step = isset($_POST['current_step']) ? (int)$_POST['current_step'] : 1;
        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Quay lại
            if (!empty($_POST['prev_step'])) {
                $current_step = (int)$_POST['prev_step'];
            } else {

                // ---------- STEP 1: sửa thông tin tour ----------
                if ($current_step === 1 && isset($_POST['next_1'])) {
                    $tour_name   = trim($_POST['tour_name'] ?? '');
                    $description = $_POST['description'] ?? '';
                    $price       = $_POST['price'] ?? '';
                    $category_id = $_POST['category_id'] ?? '';
                    $days        = (int)($_POST['days'] ?? 0);

                    if ($tour_name === '') {
                        $err['tour_name'] = "Tên tour không được để trống!";
                    }
                    if ($price === '' || $price < 0) {
                        $err['price'] = "Giá tour không hợp lệ.";
                    }
                    if ($days <= 0) {
                        $err['days'] = "Số ngày tour phải lớn hơn 0.";
                    }

                    if (empty($err)) {
                        // Ảnh: nếu up mới => upload, không thì dùng ảnh cũ
                        if (!empty($_FILES['tour_images']['name']) && $_FILES['tour_images']['size'] > 0) {
                            $tour_images = upload_file('image/TourImages', $_FILES["tour_images"]);
                        } else {
                            $tour_images = $_POST['tour_images_old'] ?? $tour['tour_images'];
                        }

                        // Lưu vào $_POST để step 2 dùng
                        $_POST['tour_images_saved'] = $tour_images;
                        $current_step = 2;
                    }
                }

                // ---------- STEP 2: sửa lịch trình & lưu ----------
                if ($current_step === 2 && isset($_POST['final_submit'])) {
                    // Lấy lại dữ liệu tour
                    $tour_name   = trim($_POST['tour_name'] ?? '');
                    $description = $_POST['description'] ?? '';
                    $price       = $_POST['price'] ?? '';
                    $category_id = $_POST['category_id'] ?? '';
                    $days        = (int)($_POST['days'] ?? 0);
                    $tour_images = $_POST['tour_images_saved'] ?? $tour['tour_images'];

                    $day_numbers = $_POST['day_number'] ?? [];
                    $titles      = $_POST['schedule_title'] ?? [];
                    $descs       = $_POST['schedule_description'] ?? [];

                    if ($tour_name === '' || $price === '' || $days <= 0) {
                        $err['empty'] = "Thiếu dữ liệu tour, vui lòng kiểm tra lại.";
                    }

                    if (empty($err)) {
                        // Update tour
                        $this->tourQuery->tour_id     = $id;
                        $this->tourQuery->tour_name   = $tour_name;
                        $this->tourQuery->description = $description;
                        $this->tourQuery->price       = $price;
                        $this->tourQuery->category_id = $category_id;
                        $this->tourQuery->tour_images = $tour_images;
                        $this->tourQuery->days        = $days;

                        $this->tourQuery->updateTour();

                        // Xoá lịch trình cũ + thêm mới
                        $this->tourQuery->deleteSchedulesByTour($id);

                        foreach ($day_numbers as $idx => $d) {
                            $d     = (int)$d;
                            $title = trim($titles[$idx] ?? '');
                            $desc  = trim($descs[$idx] ?? '');

                            if ($title === '' && $desc === '') continue;

                            $this->tourQuery->insertSchedule($id, $d, $title, $desc);
                        }

                        echo "<script>
                            alert('Cập nhật tour thành công!');
                            window.location.href='?action=admin-listTours';
                        </script>";
                        exit;
                    } else {
                        $current_step = 2;
                    }
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