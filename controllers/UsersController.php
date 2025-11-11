<?php
class UsersController {
    private $userQuery;

    function __construct() {
        $this->userQuery = new UsersQuery();
    }

    public function listUsers() {
        $users = $this->userQuery->getAllUsers();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $totalUsers = count($users);
        $totalPages = ceil($totalUsers / $perPage);
        $start = ($page - 1) * $perPage;
        $users = array_slice($users, $start, $perPage);

        require './views/User/listUser.php';
    }

    public function createUsers() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userQuery->username = $_POST['username'];
            $this->userQuery->password = $_POST['password'];
            $this->userQuery->role = $_POST['role'];
            $this->userQuery->name = $_POST['name'];
            $this->userQuery->email = $_POST['email'];
            $this->userQuery->phone = $_POST['phone'];

            $this->userQuery->createUser();
            header("Location: ?action=admin-listUsers");
            exit;
        }

        require './views/User/CreateUser.php';
    }

    public function updateUsers() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?action=admin-listUsers");
            exit;
        }

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

        require './views/User/updateUser.php';
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