<?php
class ReportController
{
    private $reportModel;
    private $guideModel;
    private $tourModel;

    public function __construct()
    {
        $this->reportModel = new ReportQuery();
        $this->guideModel = new UsersQuery();
        $this->tourModel = new ToursQuery();
    }
    public function listReports()
    {
        $reports = $this->reportModel->getAllReports();
        require './views/Report/listReport.php';
    }
    public function createReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['guide_id']) || empty($_POST['tour_id']) || empty($_POST['report_date']) || empty($_POST['content']) || empty($_POST['rating'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (empty($err)) {
                $this->reportModel->guide_id = $_POST['guide_id'];
                $this->reportModel->tour_id = $_POST['tour_id'];
                $this->reportModel->report_date = $_POST['report_date'];
                $this->reportModel->content = $_POST['content'];
                $this->reportModel->rating = $_POST['rating'];
                if ($this->reportModel->createReport()) {
                    echo "<script>
                        alert('Thêm báo cáo thành công!');
                        window.location.href='?action=admin-listReport';
                    </script>";
                    exit;
                }
            }
        }
        $guides = $this->guideModel->getAllUsers();
        $tours = $this->tourModel->getAllTours();
        require './views/Report/createReport.php';
    }
    public function updateReport($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['guide_id']) || empty($_POST['tour_id']) || empty($_POST['report_date']) || empty($_POST['content']) || empty($_POST['rating'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (empty($err)) {
                $this->reportModel->guide_id = $_POST['guide_id'];
                $this->reportModel->tour_id = $_POST['tour_id'];
                $this->reportModel->report_date = $_POST['report_date'];
                $this->reportModel->content = $_POST['content'];
                $this->reportModel->rating = $_POST['rating'];
                if (empty($err)) {
                    if ($this->reportModel->updateReport($id)) {
                        echo "<script>
                            alert('Cập nhật báo cáo thành công!');
                            window.location.href='?action=admin-listReport';
                        </script>";
                        exit;
                    }
                }
            }
        }
        $report = $this->reportModel->findReport($id);
        $guides = $this->guideModel->getAllUsers();
        $tours = $this->tourModel->getAllTours();
        require './views/Report/updateReport.php';
    }
    public function deleteReport($id)
    {
        $id = $_GET['id'] ?? null;
        if ($id)
            $this->reportModel->deleteReport($id);
        header("Location: ?action=admin-listReport");
        exit;
    }
}
?>