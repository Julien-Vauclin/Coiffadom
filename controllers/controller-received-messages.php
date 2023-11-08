<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php require_once "../models/messages.php"; ?>
<!-- FONCTIONS -->
<?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user']['ID'];
    $messageContent = $_POST['messageContent'];
    $actualDate = date("d/m/Y");
    $actualTime = date("H:i");
    if (Message::sendMessage($userId, $messageContent)) {
        // Message envoyé avec succès
        echo "Message envoyé avec succès.";
    } else {
        // Erreur lors de l'envoi du message
        echo "Erreur lors de l'envoi du message.";
    }
}
?>
<?php include "../views/received-messages.php"; ?>