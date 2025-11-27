<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Lấy danh sách các tour từ cơ sở dữ liệu
$stmt = $pdo->prepare("SELECT * FROM tours");
$stmt->execute();
$tours = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tour</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../shared/header.php'); ?>

    <div class="container">
        <h2>Quản Lý Các Tour</h2>
        <a href="add_tour.php" class="btn">Thêm Tour</a>
        <table>
            <thead>
                <tr>
                    <th>Tên Tour</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Giá</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tours as $tour): ?>
                <tr>
                    <td><?php echo $tour['tour_name']; ?></td>
                    <td><?php echo $tour['start_date']; ?></td>
                    <td><?php echo $tour['end_date']; ?></td>
                    <td><?php echo number_format($tour['price'], 0, ',', '.'); ?> VND</td>
                    <td>
                        <a href="edit_tour.php?id=<?php echo $tour['tour_id']; ?>">Sửa</a> | 
                        <a href="delete_tour.php?id=<?php echo $tour['tour_id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa tour này?');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
