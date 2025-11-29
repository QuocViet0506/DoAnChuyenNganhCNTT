<?php
class User
{
    // Hàm kiểm tra đăng nhập
    public static function login($pdo, $email, $password)
    {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu (hash)
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Hàm kiểm tra email đã tồn tại chưa
    public static function emailExists($pdo, $email)
    {
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn(); // Trả về true nếu có dữ liệu
    }

    // Hàm đăng ký người dùng mới
    public static function register($pdo, $email, $password, $phone, $role = 'customer')
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (email, password, phone, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$email, $hashed_password, $phone, $role]);
    }
}