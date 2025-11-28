<?php
require_once 'models/User.php';

class UserController {

    // Đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $role = 'customer';  // Default role is customer

            User::register($GLOBALS['pdo'], $email, $password, $phone, $role);
            header('Location: login.php');
        }

        // Hiển thị trang đăng ký
        include 'views/auth/register.php';
    }

    // Đăng nhập
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

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

    // Đăng xuất
    public function logout() {
        session_destroy();
        header('Location: login.php');
    }
}
?>
