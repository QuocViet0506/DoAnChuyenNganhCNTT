<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Kiểm tra đường dẫn ảnh đại diện
$avatar = isset($_SESSION['anh_dai_dien']) && !empty($_SESSION['anh_dai_dien']) ? $_SESSION['anh_dai_dien'] : 'assets/images/default.png';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    .navbar-brand {
        font-family: 'Pacifico', cursive;
        font-size: 1.5rem;
    }

    .hero-section {
        background: url('assets/images/background.jpg') center/cover;
        height: 500px;
        display: flex;
        align-items: center;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-water"></i> Đồng Tháp Tour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="tours.php">Danh sách Tour</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tin tức</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="dropdown">
                        <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <img src="<?php echo htmlspecialchars($avatar); ?>"
                                class="rounded-circle border border-white" width="35" height="35">
                            <span><?php echo htmlspecialchars($_SESSION['ten'] ?? 'User'); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">Hồ sơ cá nhân</a></li>
                            <li><a class="dropdown-item" href="my_bookings.php">Tour đã đặt</a></li>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <li><a class="dropdown-item" href="views/admin/dashboardadmin.php">Quản trị</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Đăng xuất</a></li>
                        </ul>
                    </div>
                    <?php else: ?>
                    <a href="views/auth/login.php" class="btn btn-light btn-sm fw-bold">Đăng Nhập</a>
                    <a href="views/auth/register.php" class="btn btn-outline-light btn-sm">Đăng Ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>