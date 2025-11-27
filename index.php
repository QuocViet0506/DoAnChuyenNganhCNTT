<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Du Lịch Đồng Tháp</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>Chào mừng đến với Tour Du Lịch Đồng Tháp</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="tours.php">Các Tour Du Lịch</a></li>
                    <li><a href="news.php">Tin Tức</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <li><a href="login.php">Đăng Nhập</a></li>
                        <li><a href="register.php">Đăng Ký</a></li>
                    <?php else: ?>
                        <li><a href="logout.php">Đăng Xuất</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <section class="intro">
            <h2>Khám Phá Đồng Tháp</h2>
            <p>Đồng Tháp là một trong những tỉnh miền Tây Nam Bộ nổi tiếng với vẻ đẹp thiên nhiên, các điểm du lịch sinh thái và đặc sản độc đáo. Hãy cùng chúng tôi khám phá các tour du lịch hấp dẫn tại đây!</p>
        </section>

        <!-- Featured Tours Section -->
        <section class="featured-tours">
            <h2>Các Tour Du Lịch Nổi Bật</h2>
            <div class="tour-list">
                <div class="tour-item">
                    <img src="assets/images/tour1.jpg" alt="Tour 1">
                    <h3>Tour Đồng Tháp Mười</h3>
                    <p>Khám phá các cánh đồng lúa mênh mông, trải nghiệm cuộc sống miền Tây đích thực.</p>
                    <a href="tour_details.php?id=1">Xem chi tiết</a>
                </div>
                <div class="tour-item">
                    <img src="assets/images/tour2.jpg" alt="Tour 2">
                    <h3>Tour Rừng Tràm</h3>
                    <p>Tham quan rừng tràm, ngắm cảnh và tìm hiểu hệ sinh thái phong phú.</p>
                    <a href="tour_details.php?id=2">Xem chi tiết</a>
                </div>
                <div class="tour-item">
                    <img src="assets/images/tour3.jpg" alt="Tour 3">
                    <h3>Tour Chợ Tình Sa Đéc</h3>
                    <p>Trải nghiệm chợ tình đặc sắc và những món ăn ngon tại Sa Đéc.</p>
                    <a href="tour_details.php?id=3">Xem chi tiết</a>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer>
            <div class="container">
                <p>&copy; 2025 Tour Du Lịch Đồng Tháp. Tất cả các quyền được bảo lưu.</p>
            </div>
        </footer>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
