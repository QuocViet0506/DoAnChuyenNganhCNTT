<?php
session_start();
require_once 'config/db.php';
require_once 'models/User.php';

// Nếu đã đăng nhập thì đá về trang chủ hoặc dashboard
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header('Location: views/admin/dashboardadmin.php');
    } else {
        header('Location: index.php');
    }
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Gọi hàm login từ Model User chuẩn
    $user = User::login($pdo, $email, $password);

    if ($user) {
        // Lưu session đầy đủ
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['ten'] = $user['full_name'] ?? $user['email']; // Fallback nếu chưa có full_name
        $_SESSION['role'] = $user['role'];
        $_SESSION['anh_dai_dien'] = $user['avatar'] ?? 'assets/images/default.png';
        $_SESSION['user'] = $user; // Lưu mảng user để tiện dùng ở view cũ

        // Điều hướng dựa trên quyền
        if ($user['role'] === 'admin') {
            header('Location: views/admin/dashboardadmin.php');
        } elseif ($user['role'] === 'guide') {
            header('Location: views/guide/dashboard.php');
        } else {
            header('Location: index.php');
        }
        exit();
    } else {
        $error = "Email hoặc mật khẩu không chính xác.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập - Tour Du Lịch Đồng Tháp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    body {
        background: url('assets/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 10px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <img src="assets/images/logo.png" alt="Logo" style="width: 80px;">
            <h3 class="mt-2 text-primary">Đăng Nhập</h3>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" required placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required placeholder="********">
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Đăng Nhập</button>
        </form>

        <div class="text-center mt-3">
            <a href="views/auth/forgot_password.php" class="text-decoration-none text-muted small">Quên mật khẩu?</a>
            <div class="mt-2">
                Chưa có tài khoản? <a href="register.php" class="fw-bold text-primary text-decoration-none">Đăng ký
                    ngay</a>
            </div>
            <div class="mt-2">
                <a href="index.php" class="text-secondary small">&larr; Về trang chủ</a>
            </div>
        </div>
    </div>
</body>

</html>