<?php
session_start(); // Khởi tạo session để kiểm tra đăng nhập
require_once 'config/db.php'; // Kết nối cơ sở dữ liệu

// Nếu đã đăng nhập thì chuyển về trang chủ
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Tạo CSRF token nếu chưa có
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(24)); // Tạo CSRF token
}

$errors = []; // Mảng lưu các lỗi
$old = ['email' => '', 'phone' => '']; // Lưu thông tin cũ khi người dùng nhập sai

// Xử lý khi người dùng gửi form đăng ký
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra CSRF token
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = 'Yêu cầu không hợp lệ. Vui lòng thử lại.';
    }

    // Lấy dữ liệu người dùng nhập vào
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $phone = trim($_POST['phone'] ?? '');

    // Lưu lại các giá trị đã nhập
    $old['email'] = $email;
    $old['phone'] = $phone;

    // Validate
    if ($email === '' || $password === '' || $phone === '') {
        $errors[] = 'Vui lòng điền đầy đủ thông tin.';
    } else {
        // Kiểm tra email hợp lệ
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ.';
        }
        // Kiểm tra mật khẩu
        if (mb_strlen($password) < 8) {
            $errors[] = 'Mật khẩu phải có ít nhất 8 ký tự.';
        }
        if ($password !== $password_confirm) {
            $errors[] = 'Mật khẩu xác nhận không khớp.';
        }
        // Kiểm tra số điện thoại hợp lệ (cho phép +, số, khoảng trắng, -)
        if (!preg_match('/^[0-9+\s\-]{7,20}$/', $phone)) {
            $errors[] = 'Số điện thoại không hợp lệ.';
        }
    }

    // Nếu không có lỗi thì kiểm tra email tồn tại và lưu
    if (empty($errors)) {
        // Kiểm tra email đã tồn tại chưa
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email này đã được đăng ký. Vui lòng chọn email khác.';
        } else {
            // Mã hóa mật khẩu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (email, password, phone, role) VALUES (?, ?, ?, 'customer')");
            $stmt->execute([$email, $hashed_password, $phone]);

            // Đăng ký thành công, chuyển hướng đến trang đăng nhập
            $_SESSION['success_message'] = "Đăng ký thành công. Bạn có thể đăng nhập ngay.";
            // Đổi CSRF token sau khi hành động thành công
            $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="register-container">
        <form method="POST" class="register-form" novalidate>
            <h2>Đăng Ký Tài Khoản</h2>

            <!-- Hiển thị thông báo lỗi nếu có -->
            <?php if (!empty($errors)): ?>
                <div style="color:red; margin-bottom:10px;">
                    <?php foreach ($errors as $e): ?>
                        <div><?php echo htmlspecialchars($e); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Thông báo thành công -->
            <?php if (!empty($_SESSION['success_message'])): ?>
                <div style="color:green; margin-bottom:10px;">
                    <?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <!-- CSRF token -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

            <!-- Form đăng ký -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($old['email']); ?>">

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirm">Xác nhận mật khẩu:</label>
            <input type="password" id="password_confirm" name="password_confirm" required>

            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required value="<?php echo htmlspecialchars($old['phone']); ?>">

            <button type="submit">Đăng Ký</button>

            <p style="text-align:center; margin-top:10px;">Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        </form>
    </div>
</body>
</html>
