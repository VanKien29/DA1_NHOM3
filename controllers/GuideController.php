<?php
class GuideController
{
    private $guideQuery;

    function __construct(){
        $this->guideQuery = new GuideQuery();
    }

    public function listGuide(){
        $guides = $this->guideQuery->getAllGuides();
        require './views/Guide/ListGuide.php';
    }

    public function createGuide(){
        $users = $this->guideQuery->getAllGuideUsers();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['user_id']) || empty($_POST['experience_years']) || empty($_POST['specialization']) || $_FILES['avatar']['size'] <= 0) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (!is_numeric($_POST['experience_years']) || $_POST['experience_years'] < 0) {
                $err['exp'] = "Kinh nghiệm phải là số >= 0.";
            }
            if($this->guideQuery->checkUserGuide($_POST['user_id'])) {
                $err['empty'] = "<script>alert('User này đã là hướng dẫn viên! Vui lòng chọn user khác.');</script>";
            }
            if (empty($err)) {
                $this->guideQuery->user_id = $_POST['user_id'];
                $this->guideQuery->experience_years = $_POST['experience_years'];
                $this->guideQuery->specialization = $_POST['specialization'];
                $this->guideQuery->note = $_POST['note'];
                
                if(isset($_FILES["avatar"]) && $_FILES["avatar"]["size"] >0){
                    $this->guideQuery->avatar = upload_file('image/GuideImages', $_FILES["avatar"]);
                }

                if ($this->guideQuery->createGuide()) {
                    echo "<script>
                        alert('Thêm hướng dẫn viên thành công!');
                        window.location.href='?action=admin-listGuide';
                    </script>";
                    exit;
                }
            }
        }
        require './views/Guide/CreateGuide.php';
    }

    public function updateGuide($id){
        $guide = $this->guideQuery->findGuide($id);
        $users = $this->guideQuery->getAllGuideUsers();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['user_id']) || empty($_POST['experience_years']) || empty($_POST['specialization'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (!is_numeric($_POST['experience_years']) || $_POST['experience_years'] < 0) {
                $err['exp'] = "Kinh nghiệm phải là số >= 0.";
            }
            
            if (empty($err)) {
                $this->guideQuery->guide_id = $id;
                $this->guideQuery->user_id = $_POST['user_id'];
                $this->guideQuery->experience_years = $_POST['experience_years'];
                $this->guideQuery->specialization = $_POST['specialization'];
                $this->guideQuery->note = $_POST['note'];

                if ($_FILES['avatar']['size'] > 0) {
                    $this->guideQuery->avatar = upload_file('image/GuideImages', $_FILES['avatar']);
                } else {
                    $this->guideQuery->avatar = $guide["avatar"];
                }

                if ($this->guideQuery->updateGuide()) {
                    echo "<script>
                        alert('Cập nhật hướng dẫn viên thành công!');
                        window.location.href='?action=admin-listGuide';
                    </script>";
                    exit;
                }
            }
        }

        require './views/Guide/UpdateGuide.php';
    }

    public function deleteGuide($id){
        if ($id) {
            if($this->guideQuery->deleteGuide($id)) {
                echo "<script>
                        alert('Xóa hướng dẫn viên thành công!');
                        window.location.href='?action=admin-listGuide';
                </script>";
                exit;
            } else {
                echo "<script>
                        alert('Không thể xoá vì HDV đang có dữ liệu liên quan!');
                        window.location.href='?action=admin-listGuide';
                </script>";
                exit;
            }
        }
    }

    public function detailGuide($id){
        $guide = $this->guideQuery->findGuide($id);
        $currentBookings = $this->guideQuery->getCurrentBookings($id);
        $historyBookings = $this->guideQuery->getHistoryBookings($id);
        require './views/Guide/DetailGuide.php';
    }
}
?>