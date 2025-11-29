<?php
session_start();
require_once 'config/db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy thông tin người dùng
$ten = $_SESSION['ten'];
$anh_dai_dien = isset($_SESSION['anh_dai_dien']) && !empty($_SESSION['anh_dai_dien'])
    ? $_SESSION['anh_dai_dien']
    : 'assets/images/default.png';

// Lấy các tour nổi bật từ cơ sở dữ liệu
$query = $pdo->prepare("SELECT * FROM tours LIMIT 3");
$query->execute();
$tours = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Đồng Tháp Tour</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: url('assets/images/dongthap.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
    }

    /* --- Header --- */
    header {
        background-color: #007bff;
        color: white;
        padding: 10px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .logo-container img {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        background: white;
        padding: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .logo-container h2 {
        font-family: 'Pacifico', cursive;
        font-size: 28px;
        color: #fff;
        margin: 0;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        object-fit: cover;
        border: 2px solid #fff;
    }

    .logout-btn {
        background-color: white;
        color: #007bff;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 500;
        transition: 0.2s;
    }

    .logout-btn:hover {
        background-color: #e3f2fd;
    }

    /* --- Thanh menu --- */
    nav {
        background-color: #e3f2fd;
        padding: 10px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #007bff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-links a {
        color: #007bff;
        text-decoration: none;
        margin: 0 15px;
        font-weight: 500;
        transition: 0.2s;
    }

    .nav-links a:hover {
        text-decoration: underline;
        color: #0056b3;
    }

    /* --- Khung nội dung --- */
    .container {
        max-width: 1100px;
        margin: 70px auto;
        background: rgba(255, 255, 255, 0.9);
        padding: 50px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        text-align: center;
    }

    h1 {
        color: #007bff;
        font-size: 30px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    p {
        font-size: 17px;
    }

    .tour-list {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .tour-item {
        width: 30%;
        text-align: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .tour-item img {
        width: 100%;
        border-radius: 8px;
    }

    .tour-item h3 {
        color: #007bff;
        font-size: 18px;
        margin: 10px 0;
    }

    .tour-item p {
        font-size: 14px;
        color: #555;
    }

    .tour-item a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .tour-item a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="assets/images/logo.png" alt="Logo Đồng Tháp Tour">
            <h2>Đồng Tháp Tour</h2>
        </div>

        <div class="user-info">
            <img src="<?php echo htmlspecialchars($anh_dai_dien); ?>" alt="Avatar">
            <a href="profile.php" style="color:white;"><b><?php echo htmlspecialchars($ten); ?></b></a> |
            <a href="logout.php" class="logout-btn">Đăng xuất</a>
        </div>
    </header>

    <nav>
        <div class="nav-links">
            <a href="index.php">Trang chủ</a>
            <a href="dat_tour.php">Đặt tour</a>
            <a href="#">Giới thiệu</a>
            <a href="#">Liên hệ</a>
            <a href="#">Ưu đãi</a>
        </div>
    </nav>

    <div class="container">
        <h1>Chào mừng <?php echo htmlspecialchars($ten); ?> đến với Đồng Tháp Tour!</h1>
        <p>Khám phá vẻ đẹp miền Tây — Đồng Tháp sen hồng 🌸</p>

        <h2>Các Tour Du Lịch Nổi Bật</h2>
        <div class="tour-list">
            <?php foreach ($tours as $tour): ?>
            <div class="tour-item">
                <img src="assets/images/<?php echo $tour['image']; ?>" alt="Tour <?php echo $tour['tour_id']; ?>">
                <h3><?php echo $tour['tour_name']; ?></h3>
                <p><?php echo $tour['description']; ?></p>
                <a href="tour_details.php?id=<?php echo $tour['tour_id']; ?>">Xem chi tiết</a>
            </div>
            <?php endforeach; ?>
        </div>

        <p style="margin-top:20px;">Trang này chỉ xem được khi bạn đã đăng nhập.</p>
    </div>
</body>

</html>