<?php
require_once 'config/db.php';
include 'views/shared/header.php';

// Xử lý tìm kiếm
$search = $_GET['q'] ?? '';
$sql = "SELECT * FROM tours WHERE status='active'";
if ($search) {
    $sql .= " AND (tour_name LIKE :search OR description LIKE :search)";
}
$sql .= " LIMIT 6";
$stmt = $pdo->prepare($sql);
if ($search) {
    $stmt->execute(['search' => "%$search%"]);
} else {
    $stmt->execute();
}
$tours = $stmt->fetchAll();
?>

<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Khám Phá Vẻ Đẹp Đất Sen Hồng</h1>
        <p class="lead mb-4">Trải nghiệm du lịch sinh thái, văn hóa và ẩm thực độc đáo tại Đồng Tháp.</p>

        <form action="index.php" method="GET" class="d-flex justify-content-center mx-auto" style="max-width: 600px;">
            <input class="form-control form-control-lg me-2" type="search" name="q"
                placeholder="Bạn muốn đi đâu? (VD: Tràm Chim...)" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-warning btn-lg fw-bold" type="submit">Tìm kiếm</button>
        </form>
    </div>
</header>

<div class="container my-5">
    <h2 class="text-center text-primary mb-4"><i class="fas fa-map-marked-alt"></i> Các Tour Nổi Bật</h2>

    <div class="row g-4">
        <?php if (count($tours) > 0): ?>
        <?php foreach ($tours as $tour): ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 hover-effect">
                <div class="position-relative">
                    <img src="assets/images/<?php echo htmlspecialchars($tour['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($tour['tour_name']); ?>"
                        style="height: 200px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded fw-bold">
                        <?php echo number_format($tour['price'], 0, ',', '.'); ?>đ
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate"><?php echo htmlspecialchars($tour['tour_name']); ?>
                    </h5>
                    <p class="card-text text-muted small"><i class="far fa-clock"></i>
                        <?php echo $tour['start_date']; ?> - <?php echo $tour['end_date']; ?></p>
                    <p class="card-text text-secondary" style="height: 4.5em; overflow: hidden;">
                        <?php echo htmlspecialchars(substr($tour['description'], 0, 100)) . '...'; ?>
                    </p>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center pb-3">
                    <a href="tour_details.php?id=<?php echo $tour['tour_id']; ?>"
                        class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    <a href="booking.php?id=<?php echo $tour['tour_id']; ?>" class="btn btn-primary btn-sm"><i
                            class="fas fa-shopping-cart"></i> Đặt ngay</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="col-12 text-center text-muted">Không tìm thấy tour nào phù hợp.</div>
        <?php endif; ?>
    </div>
</div>

<section class="bg-light py-5">
    <div class="container text-center">
        <h3 class="mb-4">Tại sao chọn chúng tôi?</h3>
        <div class="row">
            <div class="col-md-4">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h5>Uy tín hàng đầu</h5>
                <p>Dịch vụ chất lượng, đảm bảo an toàn cho mọi du khách.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-tags fa-3x text-warning mb-3"></i>
                <h5>Giá cả hợp lý</h5>
                <p>Nhiều ưu đãi hấp dẫn và chính sách giá minh bạch.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-headset fa-3x text-info mb-3"></i>
                <h5>Hỗ trợ 24/7</h5>
                <p>Đội ngũ nhân viên nhiệt tình, sẵn sàng hỗ trợ mọi lúc.</p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p>&copy; 2025 Đồng Tháp Tour. Design by QuocViet.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>