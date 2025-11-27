<?php
session_start();
include_once('../config/db.php');
include_once('../models/User.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Kiểm tra xem email có tồn tại không
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $otp = rand(100000, 999999); // Tạo mã OTP ngẫu nhiên
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Gửi OTP qua email
        $mail = new PHPMailer(true);
        try {
            $mail->setFrom('your_email@example.com', 'Tour Du Lịch Đồng Tháp');
            $mail->addAddress($email);
            $mail->Subject = 'Mã OTP khôi phục mật khẩu';
            $mail->Body    = "Mã OTP của bạn là: $otp";
            $mail->send();

            echo 'Mã OTP đã được gửi đến email của bạn.';
        } catch (Exception $e) {
            echo "Không thể gửi mã OTP. Lỗi: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu - Tour Du Lịch Đồng Tháp</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Quên Mật Khẩu</h2>
        <form action="forgot_password.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Gửi Mã OTP</button>
        </form>
        <p>Nhận mã OTP qua email để khôi phục mật khẩu của bạn.</p>
        <p>Quay lại <a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>
