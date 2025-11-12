<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #74ABE2, #5563DE);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
            letter-spacing: 1px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #5563DE;
            outline: none;
            box-shadow: 0 0 5px rgba(85, 99, 222, 0.4);
        }

        button {
            width: 100%;
            background: #5563DE;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #df0bbbff;
        }

        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
            background: #ffeaea;
            padding: 10px;
            border-radius: 8px;
        }

        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #888;
        }

        .footer a {
            color: #5563DE;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập hệ thống</h2>
        <form method="post" action="">
            <input value="admin01" type="text" name="user" placeholder="Tên đăng nhập" required>
            <input value="123456" type="password" name="pass" placeholder="Mật khẩu" required>
            <button type="submit" name="dangnhap">Đăng nhập</button>
        </form>

        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <div class="footer">
            © 2025 ND Travel | <a href="#">Quên mật khẩu?</a>
        </div>
    </div>
</body>
</html>
