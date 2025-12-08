<?php
class ProfileController
{
    private $UsersQuery;
    private $BookingQuery;

    public function __construct()
    {
        $this->UsersQuery   = new UsersQuery();
        $this->BookingQuery = new BookingQuery(); 
    }

    public function profileInfo()
    {
        $user_id = $_SESSION['user']['id'];

        // Lấy thông tin user + guide
        $user  = $this->UsersQuery->findUser($user_id);
        $guide = $this->UsersQuery->getGuideByUserId($user_id);

        // Tránh lỗi khi chưa có guide
        $guide_id = $guide['guide_id'] ?? null;

        // Tour hiện tại + hoàn thành (vẫn đúng)
        $ongoingTours    = $this->UsersQuery->getGuideTours($user_id, 'dang_dien_ra');
        $completedTours  = $this->UsersQuery->getGuideTours($user_id, 'da_hoan_thanh');

        // =============================
        //      THỐNG KÊ BOOKING
        // =============================
        $totalTours      = $guide_id ? $this->BookingQuery->countToursByGuide($guide_id) : 0;
        $finishedTours   = $guide_id ? $this->BookingQuery->countFinishedToursByGuide($guide_id) : 0;
        $runningTours    = $guide_id ? $this->BookingQuery->countRunningToursByGuide($guide_id) : 0;
        $totalCustomers  = $guide_id ? $this->BookingQuery->countCustomersByGuide($guide_id) : 0;

        $runningToursList = $guide_id ? $this->BookingQuery->getRunningTours($guide_id) : [];
        $historyTours     = $guide_id ? $this->BookingQuery->getHistoryTours($guide_id) : [];

        require './views/Profile/Profile.php';
    }

    public function updateProfile()
    {
        $id = $_SESSION['user']['id'];

        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $phone    = $_POST['phone'];
        $cccd     = $_POST['cccd'];
        $password = $_POST['password'] ?? null;

        $avatar = null;
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = upload_file('image/GuideImages', $_FILES['avatar']);
        }

        
        $this->UsersQuery->updateProfile($id, $name, $email, $phone, $password);
        $this->UsersQuery->updateGuideCCCD($id, $cccd);


        if ($avatar !== null) {
            $this->UsersQuery->updateGuideAvatar($id, $avatar);
        }

        $_SESSION['user']['name']  = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['cccd']  = $cccd;

        if ($avatar !== null) {
            $_SESSION['user']['avatar'] = $avatar;
        }

        echo "<script>
                alert('Cập nhật thông tin thành công!');
                window.location='?action=profile-info';
              </script>";
    }
}
