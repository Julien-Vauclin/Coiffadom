<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Boutons -->
<div class="divButtonsMyMessages">
    <a href="../../Coiffadom/controllers/controller-received-messages.php">
        <button id="receivedButton" class="receivedButton">Messages reçus</button>
    </a>
    <a href="../../Coiffadom/controllers/controller-sent-messages.php">
        <button id="sentButton" class="sentButton">Messages envoyés</button>
    </a>
    <a href="../../Coiffadom/controllers/controller-new-message.php">
        <button id="newMessageButton" class="newMessageButton">Nouveau message</button>
    </a>
</div>
<!-- Création du nouveau message -->
<div id="newMessage">
    <form id="newMessageForm" class="newMessageForm" method="POST">
        <div class="textareaNewMessage">
            <textarea id="messageContent" class="messageContent" name="messageContent" placeholder="Saisissez votre message ici" required></textarea>
            <button type="submit" class="sendButtonNewMessage">Envoyer</button>
        </div>
    </form>
</div>
<!-- Confirmation d'envoi du nouveau message -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var sendMessageButton = document.querySelector(".sendButtonNewMessage");

        sendMessageButton.addEventListener("click", function(event) {
            if (!confirm("Voulez-vous vraiment envoyer ce message ?")) {
                event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler".
            }
        });
    });
</script>

<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>