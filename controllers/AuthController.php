<?php
require_once "./models/AuthQuery.php";

class AuthController
{
    private $authQuery;

    public function __construct()
    {
        $this->authQuery = new AuthQuery();
    }

    public function handleLogin()
{
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['dangnhap'])) {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $user = $this->authQuery->checkLogin($username, $password);

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: ?action=admin");
            exit();
        } else {
            $error = "Sai tên đăng nhập hoặc mật khẩu!";
            include "./views/auth/login.php";
            exit();
        }
    } else {
        include "./views/auth/login.php";
        exit();
    }
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