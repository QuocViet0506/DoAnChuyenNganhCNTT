<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Xử lý cập nhật hồ sơ khi người dùng gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Kiểm tra nếu có thay đổi mật khẩu
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    } else {
        $password = $user['password']; // Giữ mật khẩu cũ nếu không thay đổi
    }

    // Cập nhật thông tin vào cơ sở dữ liệu
    $stmt = $pdo->prepare("UPDATE users SET email = ?, phone = ?, password = ? WHERE user_id = ?");
    $stmt->execute([$email, $phone, $password, $user['user_id']]);

    // Cập nhật lại session
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['phone'] = $phone;
    $_SESSION['user']['password'] = $password;
    header("Location: profile.php");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Cá Nhân - <?php echo $user['email']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <?php include('../shared/header.php'); ?>
    </header>

    <div class="container">
        <h2>Chỉnh Sửa Hồ Sơ</h2>
        <form action="profile.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>

            <label for="password">Mật khẩu mới (nếu thay đổi)</label>
            <input type="password" id="password" name="password">

            <button type="submit">Cập Nhật</button>
        </form>
    </div>
</body>
</html>
