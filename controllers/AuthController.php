<?php
require_once 'models/User.php';

class AuthController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra đăng nhập
            $user = User::login($GLOBALS['pdo'], $email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php');
            } else {
                $error = "Email hoặc mật khẩu không đúng.";
                include 'views/auth/login.php';
            }
        } else {
            include 'views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: login.php');
    }
}
?>
