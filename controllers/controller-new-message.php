<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php require_once "../models/messages.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user']['ID'];
    $messageContent = $_POST['messageContent'];
    $actualDate = date("d/m/Y");
    $actualTime = date("H:i");
    if (Message::sendMessage($userId, $messageContent)) {
        echo "<script>
        window.onload = function() {
            // On cache le formulaire
            var form = document.querySelector('form');
            form.style.display = 'none';
            // On redirige l'utilisateur vers la page d'accueil
            setTimeout(function() {
                window.location.href = '../../Coiffadom/controllers/controller-received-messages.php';
            }, 3000);
            // On affiche le décompte
            var count = 3;
            var countDown = document.createElement('p');
            countDown.innerHTML = '<p class=\"redirectToLoginMessage\">Votre message a bien été envoyé ! Redirection vers Messages reçus dans ' + count + ' secondes.</p>';
            document.body.appendChild(countDown);
            // On redirige l'utilisateur vers la page de Connexion
            var interval = setInterval(function() {
                count--;
                countDown.innerHTML = '<p class=\"redirectToLoginMessage\">Votre message a bien été envoyé ! Redirection vers Messages reçus dans ' + count + ' secondes.</p>';
                if (count === 0) {
                    clearInterval(interval);
                }
            }, 1000);
        };
    </script>";
    } else {
        echo '<script>alert("Erreur lors de l\'envoi du message.");</script>';
    }
}
?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php require_once "../models/messages.php"; ?>
<!-- FONCTIONS -->
<?php include "../views/new-message.php"; ?>