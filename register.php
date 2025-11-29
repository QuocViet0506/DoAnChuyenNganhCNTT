<?php
session_start();
// ĐƯỜNG DẪN MỚI
require_once 'config/db.php';
require_once 'models/User.php';

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    if (User::emailExists($pdo, $email)) {
        $error = "Email đã tồn tại!";
    } else {
        if (User::register($pdo, $email, $password, $phone, $role)) {
            header("Location: login.php"); // Chuyển sang file login ngay bên cạnh
            exit();
        } else {
            $error = "Đăng ký thất bại!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    body {
        background: url('assets/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .register-box {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        width: 400px;
        text-align: center;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background: green;
        color: white;
        border: none;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="register-box">
        <h2>Đăng Ký</h2>
        <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Số điện thoại" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <select name="role">
                <option value="customer">Khách hàng</option>
                <option value="guide">Hướng dẫn viên</option>
            </select>
            <button type="submit">Đăng ký</button>
        </form>
        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>

</html>