<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Boutons -->
<div class="divButtonsMyMessages">
    <a href="../../Coiffadom/controllers/controller-received-messages.php">
        <button id="receivedButton" type="button" class="receivedButton btn btn-primary position-relative">
            Messages reçus
            <?php
            $recipientId = $_SESSION['user']['ID'];
            if (message::countMessages([$recipientId]) > 0) {
                echo '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-primary border border-light rounded-circle">';
                echo message::countMessages([$recipientId]);
            }
            ?>
            <span class="visually-hidden">New alerts</span>
            </span>
        </button>
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
        <?php if ($_SESSION['user']['USER_ADMIN'] == 1) { ?>
            <?php $infosUser = User::getAllUsers($_SESSION['user']); ?>
            <label for="MESSAGE_RECIPIENT_ID" class="form-label">Destinataire :</label>
            <select name="MESSAGE_RECIPIENT_ID" id="MESSAGE_RECIPIENT_ID" class="selectInfosUser">
                <option value="" selected disabled>Choisissez un destinataire</option>
                <?php foreach (User::getAllUsers() as $user) { ?>
                    <option value="<?= $user['ID'] ?>"><?= $user['USER_FIRSTNAME'] ?> <?= $user['USER_LASTNAME'] ?></option>
                <?php } ?>
            </select>
        <?php } ?>
    </form>
</div>
<!-- Confirmation d'envoi du nouveau message -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var sendMessageButton = document.querySelector(".sendButtonNewMessage");
        var messageRecipient = document.querySelector(".MESSAGE_RECIPIENT_ID");
        sendMessageButton.addEventListener("click", function(event) {
            // On vérifie si le textarea est vide
            var messageContent = document.querySelector(".messageContent").value;
            if (messageContent == " ") {
                alert("Veuillez saisir un message.");
                event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler".
            } else if (messageRecipient == " ") {
                alert("Veuillez choisir un destinataire.");
                event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler".
            } else if (!confirm("Voulez-vous vraiment envoyer ce message ?")) {
                event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler".
            }
        });
    });
</script>


<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>