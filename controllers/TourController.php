<?php
require_once 'models/Tour.php';

class TourController {

    public function viewTour($tour_id) {
        $tour = Tour::getTourDetails($GLOBALS['pdo'], $tour_id);
        include 'views/tour/tour_view.php';
    }

    public function bookTour() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_id = $_POST['tour_id'];
            $customer_id = $_SESSION['user_id'];
            $status = 'pending';  // Default status is 'pending'

            Tour::bookTour($GLOBALS['pdo'], $customer_id, $tour_id, $status);
        }
        header('Location: tours.php');
    }
}
?>
