<?php
session_start();
require_once 'models/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = User::login($GLOBALS['pdo'], $email, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php'); // Chuyển hướng về trang chủ
        exit();
    } else {
        $error = "Email hoặc mật khẩu không đúng.";
    }
}
?>

<!-- HTML của form đăng nhập -->
<form method="POST">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
