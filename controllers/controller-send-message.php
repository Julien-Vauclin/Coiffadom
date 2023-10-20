<?php session_start(); ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../../Coiffadom/models/messages.php"; ?>
<?php var_dump($_SESSION['user']['ID']); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user']['ID'];
    $messageContent = $_POST['messageContent'];

    if (Message::sendMessage($userId, $messageContent)) {
        // Message envoyé avec succès
        echo "Message envoyé avec succès.";
    } else {
        // Erreur lors de l'envoi du message
        echo "Erreur lors de l'envoi du message.";
    }
}
