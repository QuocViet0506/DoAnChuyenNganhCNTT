<?php
class Rating {

    // Thêm đánh giá cho tour
    public static function addRating($pdo, $tour_id, $customer_id, $rating, $comment) {
        $stmt = $pdo->prepare("INSERT INTO ratings (tour_id, customer_id, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->execute([$tour_id, $customer_id, $rating, $comment]);
    }

    // Lấy các đánh giá của tour
    public static function getRatings($pdo, $tour_id) {
        $stmt = $pdo->prepare("SELECT * FROM ratings WHERE tour_id = ?");
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
