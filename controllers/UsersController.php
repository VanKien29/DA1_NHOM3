<?php
class UsersController {
    private $userQuery;

    function __construct() {
        $this->userQuery = new UsersQuery();
    }

    public function listUsers() {
        $users = $this->userQuery->getAllUsers();
        require './views/User/ListUser.php';
    }

    public function createUsers() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userQuery->username = $_POST['username'];
            $this->userQuery->password = $_POST['password'];
            $this->userQuery->role = $_POST['role'];
            $this->userQuery->name = $_POST['name'];
            $this->userQuery->email = $_POST['email'];
            $this->userQuery->phone = $_POST['phone'];

            if($username < 10){
                alert("Tên đăng nhập phải có ít nhất 10 ký tự");
            }
            $this->userQuery->createUser();
            header("Location: ?action=admin-listUsers");
            exit;
        }
        require './views/User/CreateUser.php';
    }

    public function updateUsers($id) {
        $user = $this->userQuery->findUser($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userQuery->user_id = $id;
            $this->userQuery->username = $_POST['username'];
            $this->userQuery->password = $_POST['password'];
            $this->userQuery->role = $_POST['role'];
            $this->userQuery->name = $_POST['name'];
            $this->userQuery->email = $_POST['email'];
            $this->userQuery->phone = $_POST['phone'];

            $this->userQuery->updateUser();
            header("Location: ?action=admin-listUsers");
            exit;
        }
        require './views/User/UpdateUser.php';
    }

    public function deleteUsers() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->userQuery->deleteUser($id);
        }
        header("Location: ?action=admin-listUsers");
        exit;
    }
}
?>