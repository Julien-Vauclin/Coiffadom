<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?= "aurevoir" ?>
<?php var_dump($_SESSION); ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../../Coiffadom/models/messages.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $userId = $_SESSION['user']['ID'];
    $messageContent = $_POST['messageContent'];

    if (Message::sendMessage($userId, $messageContent)) {
        // Message envoyé avec succès
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "Message envoyé avec succès.";
    } else {
        // Erreur lors de l'envoi du message
        echo "Erreur lors de l'envoi du message.";
    }
}
?>