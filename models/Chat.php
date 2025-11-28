<?php
class Chat {

    // Gửi tin nhắn
    public static function sendMessage($pdo, $sender_id, $receiver_id, $message) {
        $stmt = $pdo->prepare("INSERT INTO chat (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->execute([$sender_id, $receiver_id, $message]);
    }

    // Lấy các tin nhắn
    public static function getMessages($pdo, $user_id) {
        $stmt = $pdo->prepare("SELECT * FROM chat WHERE sender_id = ? OR receiver_id = ?");
        $stmt->execute([$user_id, $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
