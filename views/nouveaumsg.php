<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<div id="newMessage">
    <form id="newMessageForm" class="newMessageForm" method="POST">
        <div class="textareaNewMessage">
            <textarea id="messageContent" class="messageContent" name="messageContent" placeholder="Saisissez votre message ici" required></textarea>
            <button type="submit" class="sendButtonNewMessage">Envoyer</button>
        </div>
    </form>
</div>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>