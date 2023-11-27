<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>

<!-- Require -->
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php require_once "../models/messages.php"; ?>

<!-- Include -->
<?php include "../views/sent-messages.php"; ?>