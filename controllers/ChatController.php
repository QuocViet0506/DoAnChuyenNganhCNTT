<?php
require_once 'models/Chat.php';

class ChatController {

    public function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sender_id = $_SESSION['user_id'];
            $receiver_id = $_POST['receiver_id'];
            $message = $_POST['message'];

            Chat::sendMessage($GLOBALS['pdo'], $sender_id, $receiver_id, $message);
        }
        header('Location: chat.php');
    }

    public function getMessages() {
        $user_id = $_SESSION['user_id'];
        $messages = Chat::getMessages($GLOBALS['pdo'], $user_id);
        include 'views/chat/chat_view.php';
    }
}
?>
