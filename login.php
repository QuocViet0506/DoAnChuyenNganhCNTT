<?php
session_start();
require_once 'config/db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Kiểm tra email và mật khẩu
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Nếu đăng nhập thành công
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role']; // Lưu vai trò người dùng

        // Chuyển hướng đến trang chủ
        header('Location: index.php');
        exit();
    } else {
        $error = "Email hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Tour Du Lịch Đồng Tháp</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng Nhập</h2>

        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Đăng Nhập</button>
        </form>

        <p>Quên mật khẩu? <a href="reset_password.php">Khôi phục mật khẩu</a></p>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </div>
</body>
</html>
