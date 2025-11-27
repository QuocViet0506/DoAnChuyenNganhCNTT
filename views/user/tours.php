<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Lấy thông tin các tour đã đặt
$stmt = $pdo->prepare("SELECT * FROM customer_tours WHERE customer_id = ?");
$stmt->execute([$user['user_id']]);
$tours = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Các Tour Đã Đặt - <?php echo $user['email']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <?php include('../shared/header.php'); ?>
    </header>

    <div class="container">
        <h2>Các Tour Đã Đặt</h2>
        <table>
            <thead>
                <tr>
                    <th>Tên Tour</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tours as $tour): ?>
                <tr>
                    <td><?php echo $tour['tour_id']; ?></td>
                    <td><?php echo $tour['start_date']; ?></td>
                    <td><?php echo $tour['end_date']; ?></td>
                    <td><?php echo $tour['status']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
