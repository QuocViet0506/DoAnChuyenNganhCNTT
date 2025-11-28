<?php
session_start();
session_destroy();  // Hủy session khi người dùng đăng xuất
header('Location: login.php');  // Chuyển hướng người dùng về trang đăng nhập
exit();
?>
