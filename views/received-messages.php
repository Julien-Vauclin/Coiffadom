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
<!-- Affichage des messages reçus -->
<div class="receivedMessages" id="receivedMessages">
    <?php
    echo '<div class = "mymessagesReceivedMessageDiv">';
    echo '<p class = "mymessagesReceivedMessageText" style = "text-align: center; font-size: 26px;">' . "Vous n'avez pas encore reçu de message." . '</p>';
    echo '</div>';
    ?>
</div>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>