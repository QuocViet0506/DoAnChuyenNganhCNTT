<!-- header.php -->
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
