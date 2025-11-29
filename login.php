<?php
session_start();
// ĐƯỜNG DẪN MỚI: Gọi thẳng vào thư mục con, không cần lùi ra
require_once 'config/db.php';
require_once 'models/User.php';

// Nếu đã đăng nhập
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header('Location: views/admin/dashboardadmin.php');
    } else {
        header('Location: index.php');
    }
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = User::login($pdo, $email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['ten'] = $user['full_name'] ?? $user['email'];
        $_SESSION['anh_dai_dien'] = $user['avatar'] ?? 'assets/images/default.png';

        // Điều hướng
        if ($user['role'] === 'admin') {
            header("Location: views/admin/dashboardadmin.php");
        } elseif ($user['role'] === 'guide') {
            header("Location: views/guide/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Email hoặc mật khẩu không chính xác!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
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

    .login-box {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        width: 350px;
        text-align: center;
    }

    input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background: blue;
        color: white;
        border: none;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Đăng Nhập</h2>
        <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
        <p><a href="index.php">Về trang chủ</a></p>
    </div>
</body>

</html>