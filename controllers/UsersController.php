<?php
class UsersController {
    // ====== Hiển thị danh sách người dùng ======
    public function listUsers() {
        $userQuery = new UsersQuery();
        $users = $userQuery->getAllUsers();

        // Phân trang (10 user/trang)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $totalUsers = count($users);
        $totalPages = ceil($totalUsers / $perPage);
        $start = ($page - 1) * $perPage;
        $users = array_slice($users, $start, $perPage);

        require_once './views/admin/User/listUser.php';
    }

    // ====== Thêm người dùng ======
    public function createUser() {
        $userQuery = new UsersQuery();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userQuery->username = $_POST['username'];
            $userQuery->password = $_POST['password'];
            $userQuery->role = $_POST['role'];
            $userQuery->name = $_POST['name'];
            $userQuery->email = $_POST['email'];
            $userQuery->phone = $_POST['phone'];

            $userQuery->createUser();
            header("Location: ?action=admin-listUsers");
            exit;
        }

        require './views/admin/User/CreateUser.php';
    }

    // ====== Sửa người dùng ======
    public function updateUser() {
        $userQuery = new UsersQuery();

        // Lấy id user cần sửa
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?action=admin-listUsers");
            exit;
        }

        // Lấy dữ liệu user cũ
        $user = $userQuery->findUser($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userQuery->user_id = $id;
            $userQuery->username = $_POST['username'];
            $userQuery->password = $_POST['password'];
            $userQuery->role = $_POST['role'];
            $userQuery->name = $_POST['name'];
            $userQuery->email = $_POST['email'];
            $userQuery->phone = $_POST['phone'];

            $userQuery->updateUser();
            header("Location: ?action=admin-listUsers");
            exit;
        }

        require './views/admin/User/updateUser.php';
    }

    // ====== Xóa người dùng ======
    public function deleteUser() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $userQuery = new UsersQuery();
            $userQuery->deleteUser($id);
        }
        header("Location: ?action=admin-listUsers");
        exit;
    }
}
?>
