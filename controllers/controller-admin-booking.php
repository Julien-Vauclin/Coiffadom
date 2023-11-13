<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/booking.php"; ?>
<!-- fonctions -->
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['accept'])) {
        BookingAdmin::acceptBooking($_POST['accept']);
        echo "BOOKING ACCEPTE";
        var_dump($_POST['accept']);
    } else if (isset($_POST['refuse'])) {
        BookingAdmin::refuseBooking($_POST['refuse']);
        echo "BOOKING REFUSE";
        var_dump($_POST['refuse']);
    }
}
?>
<?php include "../views/admin-booking.php"; ?>