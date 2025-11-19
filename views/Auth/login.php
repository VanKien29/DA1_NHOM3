<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
    * {
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1500&q=80') no-repeat center center/cover;
    }

    /* Hiệu ứng làm mờ nền form */
    .login-container {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        padding: 40px 50px;
        width: 360px;
        text-align: center;
        color: #fff;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    h2 {
        margin-bottom: 25px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 10px 0 18px;
        border: none;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        font-size: 15px;
        transition: 0.3s;
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    input:focus {
        background: rgba(255, 255, 255, 0.3);
        outline: none;
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.4);
    }

    button {
        width: 100%;
        background: rgba(255, 255, 255, 0.85);
        color: #111;
        border: none;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #fff;
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
    }

    .options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
        margin: 10px 0 20px;
    }

    .options a {
        color: #fff;
        text-decoration: none;
        transition: 0.2s;
    }

    .options a:hover {
        text-decoration: underline;
    }

    .footer {
        margin-top: 15px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.7);
    }

    .footer a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .error {
        margin-top: 10px;
        background: rgba(255, 100, 100, 0.2);
        border: 1px solid rgba(255, 100, 100, 0.4);
        color: #ffbfbf;
        padding: 10px;
        border-radius: 6px;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="user" placeholder="Enter your email" value="admin02" required>
            <input type="password" name="pass" placeholder="Enter your password" value="123456" required>
            <button type="submit">Log In</button>

            <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>