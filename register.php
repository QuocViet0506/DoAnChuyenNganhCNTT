<?php
session_start();
require_once 'config/db.php';
require_once 'models/User.php';

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Tạo CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
}

$errors = [];
$old = ['email' => '', 'phone' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check CSRF
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = 'Lỗi bảo mật. Vui lòng thử lại.';
    }

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $phone = trim($_POST['phone'] ?? '');

    $old['email'] = $email;
    $old['phone'] = $phone;

    // Validate cơ bản
    if (empty($email) || empty($password) || empty($phone)) {
        $errors[] = 'Vui lòng điền đầy đủ thông tin.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không hợp lệ.';
    } elseif (mb_strlen($password) < 6) {
        $errors[] = 'Mật khẩu phải từ 6 ký tự trở lên.';
    } elseif ($password !== $password_confirm) {
        $errors[] = 'Mật khẩu xác nhận không khớp.';
    } else {
        // Kiểm tra email trùng lặp qua Model
        if (User::emailExists($pdo, $email)) {
            $errors[] = 'Email này đã được sử dụng.';
        } else {
            // Đăng ký qua Model
            if (User::register($pdo, $email, $password, $phone, 'customer')) {
                $_SESSION['success_message'] = "Đăng ký thành công! Bạn có thể đăng nhập ngay.";
                // Reset token
                unset($_SESSION['csrf_token']);
                header('Location: login.php');
                exit();
            } else {
                $errors[] = 'Lỗi hệ thống, vui lòng thử lại sau.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Ký - Đồng Tháp Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    body {
        background: url('assets/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-container {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 10px;
        width: 100%;
        max-width: 450px;
        margin: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    </style>
</head>

<body>
    <div class="register-container">
        <h3 class="text-center text-primary mb-4">Đăng Ký Tài Khoản</h3>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                <?php foreach ($errors as $e): ?>
                <li><?php echo htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" required
                    value="<?php echo htmlspecialchars($old['email']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" required
                    value="<?php echo htmlspecialchars($old['phone']); ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nhập lại MK</label>
                    <input type="password" name="password_confirm" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 fw-bold">Đăng Ký</button>
        </form>

        <div class="text-center mt-3">
            <span class="text-muted">Đã có tài khoản?</span>
            <a href="login.php" class="fw-bold text-decoration-none">Đăng nhập ngay</a>
        </div>
    </div>
</body>

</html>