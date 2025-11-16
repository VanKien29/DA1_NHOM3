<?php

class TourGuideController
{
    private $tourGuideQuery;
    private $guideQuery;
    private $tourModel;

    public function __construct()
    {
        $this->tourGuideQuery = new TourGuideQuery();
        $this->guideQuery = new GuideQuery();
        $this->tourModel = new ToursQuery();
    }

    // ===================== DANH SÁCH =====================
    public function listTourGuides()
    {
        $guides = $this->tourGuideQuery->getAllTourGuides();
        require './views/TourGuide/ListTourGuide.php';
    }

    // ===================== THÊM PHÂN CÔNG =====================
    public function createTourGuide()
    {
        $allGuides = $this->guideQuery->getAllGuides();
        $tours = $this->tourModel->getAllTours();
        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tour_id = $_POST['tour_id'];
            $guide_id = $_POST['guide_id'];
            $assigned_date = $_POST['assigned_date'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $status = $_POST['status'];

            // Validate rỗng
            if (empty($tour_id) || empty($guide_id) || empty($assigned_date) ||
                empty($start_date) || empty($end_date)) {
                $err['empty'] = "Vui lòng nhập đầy đủ thông tin!";
            }

            // Validate ngày
            if ($start_date > $end_date) {
                $err['date'] = "Ngày bắt đầu không được lớn hơn ngày kết thúc!";
            }

            // Kiểm tra trùng lịch
            if ($this->tourGuideQuery->isDateConflict($tour_id, $guide_id, $start_date, $end_date)) {
                $err['conflict'] = "Hướng dẫn viên đã bận trong khoảng thời gian này!";
            }

            if (empty($err)) {
                $this->tourGuideQuery->tour_id = $tour_id;
                $this->tourGuideQuery->guide_id = $guide_id;
                $this->tourGuideQuery->assigned_date = $assigned_date;
                $this->tourGuideQuery->start_date = $start_date;
                $this->tourGuideQuery->end_date = $end_date;
                $this->tourGuideQuery->status = $status;

                if ($this->tourGuideQuery->createTourGuide()) {
                    echo "<script>
                        alert('Thêm phân công thành công!');
                        window.location.href='?action=admin-listTourGuide';
                    </script>";
                    exit;
                }
            }
        }

        require './views/TourGuide/CreateTourGuide.php';
    }

    // ===================== CẬP NHẬT PHÂN CÔNG =====================
    public function updateTourGuide($id)
    {
        $guide = $this->tourGuideQuery->findTourGuide($id);
        $allGuides = $this->guideQuery->getAllGuides();
        $tours = $this->tourModel->getAllTours();
        $err = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tour_id = $_POST['tour_id'];
            $guide_id = $_POST['guide_id'];
            $assigned_date = $_POST['assigned_date'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $status = $_POST['status'];

            // Validate rỗng
            if (empty($tour_id) || empty($guide_id) || empty($assigned_date) ||
                empty($start_date) || empty($end_date)) {
                $err['empty'] = "Vui lòng nhập đầy đủ thông tin!";
            }

            // Validate ngày
            if ($start_date > $end_date) {
                $err['date'] = "Ngày bắt đầu không được lớn hơn ngày kết thúc!";
            }

            // Kiểm tra trùng lịch (ngoại trừ chính nó)
            if ($this->tourGuideQuery->isDateConflict($tour_id, $guide_id, $start_date, $end_date, $id)) {
                $err['conflict'] = "Hướng dẫn viên đã bận trong khoảng thời gian này!";
            }

            if (empty($err)) {
                $this->tourGuideQuery->id = $id;
                $this->tourGuideQuery->tour_id = $tour_id;
                $this->tourGuideQuery->guide_id = $guide_id;
                $this->tourGuideQuery->assigned_date = $assigned_date;
                $this->tourGuideQuery->start_date = $start_date;
                $this->tourGuideQuery->end_date = $end_date;
                $this->tourGuideQuery->status = $status;

                if ($this->tourGuideQuery->updateGuide()) {
                    echo "<script>
                        alert('Cập nhật phân công thành công!');
                        window.location.href='?action=admin-listTourGuide';
                    </script>";
                    exit;
                }
            }
        }

        require './views/TourGuide/UpdateTourGuide.php';
    }

    // ===================== XOÁ PHÂN CÔNG =====================
    public function deleteTourGuide($id)
    {
        if ($this->tourGuideQuery->deleteTourGuide($id)) {
            echo "<script>
                alert('Xóa thành công!');
                window.location.href='?action=admin-listTourGuide';
            </script>";
        } else {
            echo "<script>
                alert('Không thể xóa vì dữ liệu đang được sử dụng!');
                window.location.href='?action=admin-listTourGuide';
            </script>";
        }
        exit;
    }
}
?>