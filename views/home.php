<?php session_start(); ?>
<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<p>Ceci est ma homepage</p>
<?php
$msghaha = "pas connecté";
echo $msghaha;
if (isset($_SESSION['user'])) {
    $firstname = $_SESSION['user']['firstname'];
    $lastname = $_SESSION['user']['lastname'];
    $msghaha = "Bienvenue $firstname $lastname !";
} else {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté.
    header('Location:../../Coiffadom/controllers/controller-login.php');
    exit();
}
echo $msghaha;
?>
<?php include "components/footer.php" ?>