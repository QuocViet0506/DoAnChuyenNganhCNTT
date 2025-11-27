<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
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
    <title>Trang Dashboard Quản Trị Viên</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../shared/header.php'); ?>

    <div class="container">
        <h2>Chào mừng, <?php echo $user['email']; ?>!</h2>
        <p>Trang Dashboard Quản Trị Viên. Quản lý người dùng, tour và các thông báo tại đây.</p>

        <nav>
            <ul>
                <li><a href="manage_users.php">Quản lý người dùng</a></li>
                <li><a href="manage_tours.php">Quản lý các tour</a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        </nav>

        <section>
            <h3>Thông tin tổng quan</h3>
            <p>Số lượng tour hiện có: <strong>10</strong></p>
            <p>Số lượng người dùng đăng ký: <strong>500</strong></p>
        </section>
    </div>
</body>
</html>
