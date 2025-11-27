<?php
session_start();
if (!isset($_SESSION['user'])) {
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
    <title>Trang Dashboard - <?php echo $user['email']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <?php include('../shared/header.php'); ?>
    </header>

    <div class="container">
        <h2>Chào mừng, <?php echo $user['email']; ?>!</h2>
        <p>Trang Dashboard của bạn. Quản lý các tour và hồ sơ cá nhân tại đây.</p>

        <nav>
            <ul>
                <li><a href="profile.php">Hồ sơ cá nhân</a></li>
                <li><a href="tours.php">Các tour đã đặt</a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        </nav>

        <section>
            <h3>Thông tin tour</h3>
            <!-- Bạn có thể hiển thị danh sách các tour đã đặt tại đây -->
        </section>
    </div>
</body>
</html>
