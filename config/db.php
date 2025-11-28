<?php
$host = 'localhost';  // Server MySQL
$dbname = 'tourdulichDT';  // Tên cơ sở dữ liệu
$username = 'root';  // Tên người dùng MySQL
$password = '';  // Mật khẩu MySQL (nếu có)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Kết nối thất bại: ' . $e->getMessage();
}
?>
