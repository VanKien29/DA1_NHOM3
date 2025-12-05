<?php

class ProfileController
{

    private $UsersQuery;

    public function __construct()
    {
        $this->UsersQuery = new UsersQuery();
    }
    public function profileInfo()
    {
        $user_id = $_SESSION['user']['id'];
        $user = $this->UsersQuery->findUser($user_id);
        $guide = $this->UsersQuery->getGuideByUserId($user_id);
        $ongoingTours = $this->UsersQuery->getGuideTours($user_id, 'dang_dien_ra');
        $completedTours = $this->UsersQuery->getGuideTours($user_id, 'da_hoan_thanh');

        require './views/Profile/Profile.php';
    }
    public function updateProfile()
    {
        $id = $_SESSION['user']['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $cccd = $_POST['cccd'];
        $avatar = null;
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = upload_file('image/GuideImages', $_FILES['avatar']);
        }
        $this->UsersQuery->updateProfile($id, $name, $email, $phone, $cccd, $avatar);
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['cccd'] = $cccd;
        if ($avatar)
            $_SESSION['user']['avatar'] = $avatar;

        echo "<script>
              alert('Cập nhật thông tin thành công!');
              window.location='?action=profile-info';
              </script>";
    }
}
