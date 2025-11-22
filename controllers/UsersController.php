<?php
class UsersController
{
    private $userQuery;

    function __construct()
    {
        $this->userQuery = new UsersQuery();
    }

    public function listUsers()
    {
        $users = $this->userQuery->getAllUsers();
        require './views/User/ListUser.php';
    }
    public function searchUsers()
    {
        $keyword = $_GET['keyword'] ?? '';
        $users = $this->userQuery->searchUsers($keyword);
        require './views/User/ListUser.php';
    }

    public function createUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (strlen($_POST['username']) <= 6) {
                $err['username'] = "Tên người dùng phải trên 6 kí tự.";
            }
            if (strpbrk($_POST['name'], '0123456789') || strlen($_POST['name']) <= 6) {
                $err['name'] = "Tên phải trên 6 kí tự và không chứa số.";
            }
            if (strlen($_POST['password']) <= 6) {
                $err['password'] = "Mật khẩu phải trên 6 kí tự";
            }
            if (!preg_match("/^\+?\d{9,12}$/", $_POST['phone'])) {
                $err['phone'] = "Số điện thoại không hợp lệ.";
            }
            if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $_POST['email'])) {
                $err['email'] = "Email không hợp lệ.";
            }
            if (empty($err)) {
                $this->userQuery->username = $_POST['username'];
                $this->userQuery->password = $_POST['password'];
                $this->userQuery->role = $_POST['role'];
                $this->userQuery->name = $_POST['name'];
                $this->userQuery->email = $_POST['email'];
                $this->userQuery->phone = $_POST['phone'];
                if ($this->userQuery->createUser()) {
                    echo "<script>
                        alert('Thêm quản trị thành công!');
                        window.location.href='?action=admin-listUsers';
                    </script>";
                    exit;
                }
            }
        }
        require './views/User/CreateUser.php';
    }

    public function updateUsers($id)
    {
        $user = $this->userQuery->findUser($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
           if (strlen($_POST['username']) <= 6) {
                $err['username'] = "Tên người dùng phải trên 6 kí tự.";
            }
            if (strpbrk($_POST['name'], '0123456789') || strlen($_POST['name']) <= 6) {
                $err['name'] = "Tên phải trên 6 kí tự và không chứa số.";
            }
            if (strlen($_POST['password']) <= 6) {
                $err['password'] = "Mật khẩu phải trên 6 kí tự";
            }
            if (!preg_match("/^\+?\d{9,12}$/", $_POST['phone'])) {
                $err['phone'] = "Số điện thoại không hợp lệ.";
            }
            if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $_POST['email'])) {
                $err['email'] = "Email không hợp lệ.";
            }
            if (empty($err)) {
                $this->userQuery->user_id = $id;
                $this->userQuery->username = $_POST['username'];
                $this->userQuery->password = $_POST['password'];
                $this->userQuery->role = $_POST['role'];
                $this->userQuery->name = $_POST['name'];
                $this->userQuery->email = $_POST['email'];
                $this->userQuery->phone = $_POST['phone'];

                if ($this->userQuery->updateUser()) {
                    echo "<script>
                        alert('Sửa quản trị thành công!');
                        window.location.href='?action=admin-listUsers';
                    </script>";
                    exit;
                }
            }
        }
        require './views/User/UpdateUser.php';
    }

    public function deleteUsers($id)
    {
        if ($id) {
            if ($this->userQuery->deleteUser($id)) {
                echo "<script>
                    alert('Xóa người dùng thành công!');
                    window.location.href='?action=admin-listUsers';
            </script>";
                exit;
            } else {
                echo "<script>
                    alert('Không thể xoá người dùng vì đang có dữ liệu liên quan!');
                    window.location.href='?action=admin-listUsers';
            </script>";
                exit;
            }
        }
    }
}
?>