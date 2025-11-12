<?php

class AuthController
{
    private $UsersQuery;

    public function __construct()
    {
        $this->UsersQuery = new UsersQuery();
    }

    public function login() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $user = $this->UsersQuery->checkLogin($username, $password);
        var_dump($user);

        if ($user) {
            $_SESSION['user'] = [
                'id'   => $user['user_id'],
                'name' => $user['name'],
                'role' => $user['role'],
            ];
            header("Location: ?action=admin");
            exit();
        }else {
            $error = "Sai tên đăng nhập hoặc mật khẩu!";
            require "./views/auth/login.php";
            exit();
        }
    }
    require "./views/auth/login.php";
}

   public function logout()
{
    session_start();
    session_destroy();
    header("Location: ?action=login");
    exit();
}
}
?>