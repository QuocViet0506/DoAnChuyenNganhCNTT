<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Lấy danh sách người dùng
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../shared/header.php'); ?>

    <div class="container">
        <h2>Quản Lý Người Dùng</h2>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Vai Trò</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo ucfirst($user['role']); ?></td>
                    <td><?php echo ucfirst($user['status']); ?></td>
                    <td>
                        <?php if ($user['status'] === 'active'): ?>
                            <a href="lock_user.php?id=<?php echo $user['user_id']; ?>">Khóa</a>
                        <?php else: ?>
                            <a href="unlock_user.php?id=<?php echo $user['user_id']; ?>">Mở khóa</a>
                        <?php endif; ?>
                        | 
                        <a href="edit_user.php?id=<?php echo $user['user_id']; ?>">Sửa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
