<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php require_once "../models/messages.php"; ?>
<!-- FONCTIONS -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageContent'])) {
    $userId = $_SESSION['user']['id'];
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
<?php include "../views/mymessages.php"; ?>