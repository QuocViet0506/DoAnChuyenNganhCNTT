<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'guide') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat với Khách Hàng</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../shared/header.php'); ?>

    <div class="container">
        <h2>Chat với Khách Hàng</h2>
        <div class="chat-box">
            <!-- Nội dung chat sẽ được hiển thị ở đây -->
            <div class="messages" id="messages">
                <!-- Các tin nhắn sẽ được hiển thị ở đây -->
            </div>
            <input type="text" id="messageInput" placeholder="Nhập tin nhắn..." />
            <button id="sendMessage">Gửi</button>
        </div>
    </div>

    <script>
        document.getElementById('sendMessage').onclick = function() {
            var message = document.getElementById('messageInput').value;
            if (message.trim() !== '') {
                var messageDiv = document.createElement('div');
                messageDiv.textContent = message;
                document.getElementById('messages').appendChild(messageDiv);
                document.getElementById('messageInput').value = '';
            }
        };
    </script>
</body>
</html>
