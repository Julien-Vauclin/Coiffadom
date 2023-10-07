<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<p>page my account VIEWS</p>
<!-- TEST CONNEXION -->
<?php
if (isset($_SESSION['user'])) {
    $firstname = $_SESSION['user']['firstname'];
    $lastname = $_SESSION['user']['lastname'];
    $welcomeMessage = "Bienvenue $firstname $lastname !";
    echo "<p>$welcomeMessage</p>";
} else {
    $notLoggedMessage = "Vous n'êtes pas connecté(e)";
    echo "<p>$notLoggedMessage</p>";
    exit();
    session_destroy();
}
?>
<!-- FIN TEST CONNEXION -->
<?php require_once "components/footer.php" ?>