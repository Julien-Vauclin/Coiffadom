<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php if (isset($_SESSION['user']) && ($_SESSION['user']['USER_ADMIN'] == 1)) {
    header("Location: ../../Coiffadom/controllers/controller-admin-booking.php");
    exit;
} ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/booking-price.php"; ?>
<?php require_once "../models/booking.php"; ?>
<!-- FONCTIONS -->
<?php
$userId = $_SESSION['user']['ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cancelBooking = $_POST['cancel'];
    BookingAdmin::cancelBooking($cancelBooking);
    $SESSION_USER_ID = BookingAdmin::getBookingByUser($userId);
}
$displayBookingsByUserId = BookingAdmin::getBookingByUser($userId);
?>

<?php include "../views/my-bookings.php"; ?>