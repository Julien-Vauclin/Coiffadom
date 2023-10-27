<?php session_start(); ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../../Coiffadom/models/messages.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];
    if (Message::deleteMessage($messageId)) {
        // La suppression a réussi, renvoyer une réponse appropriée
        echo "Message supprimé avec succès.";
    } else {
        // Erreur lors de la suppression du message
        echo "Erreur lors de la suppression du message.";
    }
}
?>