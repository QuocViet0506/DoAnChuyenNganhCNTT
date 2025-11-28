<?php
session_start(); // Khởi tạo session để kiểm tra đăng nhập
?>

<header>
    <div class="container">
        <div class="logo">
            <h1><a href="index.php">Tour Du Lịch Đồng Tháp</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="tours.php">Các Tour Du Lịch</a></li>
                <li><a href="news.php">Tin Tức</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
                
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Hiển thị đăng nhập và đăng ký nếu người dùng chưa đăng nhập -->
                    <li><a href="login.php">Đăng Nhập</a></li>
                    <li><a href="register.php">Đăng Ký</a></li>
                <?php else: ?>
                    <!-- Hiển thị thông tin người dùng và đăng xuất nếu đã đăng nhập -->
                    <li><a href="profile.php">Hồ sơ</a></li> <!-- Trang hồ sơ cho người dùng đã đăng nhập -->
                    <li><a href="logout.php">Đăng Xuất</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
