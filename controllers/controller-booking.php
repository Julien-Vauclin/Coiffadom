<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php if (isset($_SESSION['user']) && ($_SESSION['user']['USER_ADMIN'] == 1)) {
    header("Location: ../../Coiffadom/controllers/controller-admin-booking.php");
    exit;
} ?>

<!-- Require -->
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/booking-price.php"; ?>

<!-- FONCTIONS -->
<!-- On initialise les messages d'erreur -->
<?php $hairstyleTypeError = $hairstyleLengthError = $hairstyleDateError = $hairstyleTimeError = ""; ?>
<!-- On affiche les valeurs -->

<?php
// Initialisation de la variable d'erreur
$error = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    if (isset($_POST['confirmBooking'])) {
        Booking::createBooking($hairstyleDate, $hairstyleTime, $hairstyleDuration, $_SESSION['user']['ID'], $hairstyleType, $hairstylePrice, $hairstyleLength);
        echo "<script>
        window.onload = function() {
            // On cache la modal
            myModal.hide();
            // On cache le formulaire
            var form = document.querySelector('form');
            form.style.display = 'none';
            // On redirige l'utilisateur vers la page d'accueil
            setTimeout(function() {
                window.location.href = '../../Coiffadom/controllers/controller-myaccount.php';
            }, 3000);
            // On affiche le décompte
            var count = 3;
            var countDown = document.createElement('p');
            countDown.innerHTML = '<p class=\"redirectToLoginMessage\">Votre rendez-vous a bien été enregistré ! Redirection vers Mon compte dans ' + count + ' secondes.</p>';
            document.body.appendChild(countDown);
            // On redirige l'utilisateur vers la page de Connexion
            var interval = setInterval(function() {
                count--;
                countDown.innerHTML = '<p class=\"redirectToLoginMessage\">Votre rendez-vous a bien été enregistré ! Redirection vers Mon compte dans ' + count + ' secondes.</p>';
                if (count === 0) {
                    clearInterval(interval);
                }
            }, 1000);
        };
    </script>";
    }
}
?>


<?php include "../views/booking.php"; ?>