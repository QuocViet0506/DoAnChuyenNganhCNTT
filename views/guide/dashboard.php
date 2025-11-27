<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'guide') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Dashboard Hướng Dẫn Viên</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../shared/header.php'); ?>

    <div class="container">
        <h2>Chào mừng, <?php echo $user['email']; ?></h2>
        <p>Đây là trang dashboard của bạn. Bạn có thể xem các tour mà bạn đã nhận và các thông báo liên quan đến các tour đó.</p>

        <nav>
            <ul>
                <li><a href="tours.php">Danh sách Tour</a></li>
                <li><a href="chat.php">Chat với khách hàng</a></li>
                <li><a href="chat.php">Chat với quản trị viên</a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
