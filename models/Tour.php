<?php
class Tour {

    // Lấy chi tiết tour
    public static function getTourDetails($pdo, $tour_id) {
        $stmt = $pdo->prepare("SELECT * FROM tours WHERE tour_id = ?");
        $stmt->execute([$tour_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Đặt tour
    public static function bookTour($pdo, $customer_id, $tour_id, $status) {
        $stmt = $pdo->prepare("INSERT INTO customer_tours (customer_id, tour_id, status) VALUES (?, ?, ?)");
        $stmt->execute([$customer_id, $tour_id, $status]);
    }
}
?>
