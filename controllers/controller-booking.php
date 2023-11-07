<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/booking-price.php"; ?>
<!-- FONCTIONS -->
<!-- On initialise les messages d'erreur -->
<?php $hairstyleTypeError = $hairstyleLengthError = $hairstyleDateError = $hairstyleTimeError = ""; ?>
<!-- On affiche les valeurs -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = 0;
    $hairstyleDate = $_POST['hairstyleDate']; // BOOKING_DATE
    $hairstyleTime = $_POST['hairstyleTime']; // BOOKING_TIME
    $hairstyleDuration = $_POST['hairstyleDuration']; // BOOKING_DURATION
    $hairstylePrice = $_POST['hairstylePrice']; // BOOKING_COST
    if ($hairstyleDate === "") {
        $hairstyleDateError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $error++;
    };
    if ($hairstyleTime === "") {
        $hairstyleTimeError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $error++;
    };
    if ($hairstyleDuration === "") {
        $hairstyleDurationError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $error++;
    };
    if ($hairstylePrice === "") {
        $hairstylePriceError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $error++;
    };

    if (isset($_POST['hairstyleType'])) {
        $hairstyleType = $_POST['hairstyleType']; // HAIRSTYLE_ID
    } else {
        $hairstyleTypeError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $error++;
    };

    if (isset($_POST['hairstyleLength'])) {
        $hairstyleLength = $_POST['hairstyleLength']; // HAIRSTYLE_LENGTH
    } else {
        $hairstyleLengthError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $error++;
    };
    if ($error === 0) {
        Booking::createBooking($hairstyleDate, $hairstyleTime, $hairstyleDuration, $_SESSION['user']['ID'], $hairstyleType, $hairstylePrice, $hairstyleLength);
    }
}
?>

<?php include "../views/booking.php"; ?>