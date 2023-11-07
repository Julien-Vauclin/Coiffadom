<?php session_start(); ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<p>Ceci est ma homepage</p>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>
<!-- TEST CONNEXION -->
<?php
if (isset($_SESSION['user'])) {
    $USER_FIRSTNAME = $_SESSION['user']['USER_FIRSTNAME'];
    $USER_LASTNAME = $_SESSION['user']['USER_LASTNAME'];
    $welcomeMessage = "Bienvenue $USER_FIRSTNAME $USER_LASTNAME !";
    echo "<p>$welcomeMessage</p>";
} else {
    $notLoggedMessage = "Vous n'êtes pas connecté(e)";
    echo "<p>$notLoggedMessage</p>";
    exit();
    session_destroy();
}
?>
<!-- Verif admin -->
<?php
if ($_SESSION['user']['USER_ADMIN'] == 1) {
    echo "<p>Vous êtes admin !</p>";
} else {
    echo "<p>Vous n'êtes pas admin ...</p>";
}
?>
<!-- FIN TEST CONNEXION -->