<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'guide') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Lấy danh sách các tour mà hướng dẫn viên đã nhận
$stmt = $pdo->prepare("SELECT * FROM customer_tours WHERE guide_id = ?");
$stmt->execute([$user['user_id']]);
$tours = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Các Tour Đã Nhận</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../shared/header.php'); ?>

    <div class="container">
        <h2>Các Tour Đã Nhận</h2>
        <table>
            <thead>
                <tr>
                    <th>Tên Tour</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Trạng Thái</th>
                    <th>Chấp Nhận</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tours as $tour): ?>
                <tr>
                    <td><?php echo $tour['tour_id']; ?></td>
                    <td><?php echo $tour['start_date']; ?></td>
                    <td><?php echo $tour['end_date']; ?></td>
                    <td><?php echo $tour['status']; ?></td>
                    <td>
                        <?php if ($tour['status'] === 'pending'): ?>
                            <a href="accept_tour.php?id=<?php echo $tour['customer_tour_id']; ?>">Chấp Nhận</a>
                        <?php else: ?>
                            <span>Đã chấp nhận</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
