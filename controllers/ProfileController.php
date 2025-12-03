<?php
class ProfileController {

    private $UserQuery;

    public function __construct() {
        $this->UserQuery = new UsersQuery();
    }
    public function profileInfo() {
    $user_id = $_SESSION['user']['id'];
    $user = $this->UserQuery->findUser($user_id);
    $ongoingTours = $this->UserQuery->getGuideTours($user_id, 'dang_dien_ra');
    $completedTours = $this->UserQuery->getGuideTours($user_id, 'hoan_thanh');
    require './views/Profile/Profile.php';
}
    public function updateProfile() {
        $id = $_SESSION['user']['id'];
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $avatar = null;
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = upload_file('image/UserAvatar', $_FILES['avatar']);
        }
        $this->UserQuery->updateProfile($id, $name, $email, $phone, $avatar);
        $_SESSION['user']['name']  = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone'] = $phone;
        if ($avatar) $_SESSION['user']['avatar'] = $avatar;

        echo "<script>
              alert('Cập nhật thông tin thành công!');
              window.location='?action=profile-info';
              </script>";
    }
}
