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
    exit();
}
echo $msghaha;
?>
<?php include "components/footer.php" ?>