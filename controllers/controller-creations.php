<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php require_once "../models/haircut.php"; ?>
<!-- fonctions -->
<?php include "../views/creations.php"; ?>