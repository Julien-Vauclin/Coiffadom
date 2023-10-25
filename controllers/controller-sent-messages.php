<?php session_start(); ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../../Coiffadom/models/messages.php"; ?>
<!-- On affiche les messages envoyés par l'utilisateur connecté -->
<?php
function displaySentMessages()
{
    // Vérifiez si l'URL contient "#sent"
    $urlFragment = parse_url($_SERVER['REQUEST_URI'], PHP_URL_FRAGMENT);

    if ($urlFragment === 'sent') {
        $userId = $_SESSION['user']['ID'];
        $messages = Message::getMessagesByUserId($userId);
        foreach ($messages as $message) {
            echo "<div class='sentMessages'>";
            echo "<p>" . $message['MESSAGE_CONTENT'] . "</p>";
            echo "<p>" . $message['MESSAGE_USER_ID'] . "</p>";
            echo "</div>";
        }
    }
}
?>
<p>CONTROLLER SENT MESSAGES</p>
<?php include "../views/mymessages.php"; ?>