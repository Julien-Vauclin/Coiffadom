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

<!-- Affichage des messages reçus -->
<div class="receivedMessages" id="receivedMessages">
    <?php
    $userId = $_SESSION['user']['ID'];
    $messages = Message::getMessagesByUserId($userId);
    if (empty($messages)) {
        echo '<div class = "mymessagesReceivedMessageDiv">';
        echo '<p class = "mymessagesReceivedMessageText" style = "text-align: center; font-size: 26px;">' . "Vous n'avez pas encore reçu de message." . '</p>';
        echo '</div>';
    } else {
        echo '<div class = "mymessagesReceivedMessageDiv">';
        foreach ($messages as $message) {
            echo  '<div class = "receivedMessageDiv">';
            echo '<p class = "mymessagesReceivedMessageText">' . htmlspecialchars($message['MESSAGE_CONTENT'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<div class = "dateAndDeleteButton">';
            echo 'Reçu le ' . htmlspecialchars($message['MESSAGE_DATE'] = date("d/m/Y", strtotime($message['MESSAGE_DATE'])), ENT_QUOTES, 'UTF-8') . " à " . htmlspecialchars($message['MESSAGE_TIME'], ENT_QUOTES, 'UTF-8') . '<br>' . 'De la part de ' . htmlspecialchars($message['USER_FIRSTNAME'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($message['USER_LASTNAME'], ENT_QUOTES, 'UTF-8');
            echo '<button class="receivedMessagesAdminDeleteButton" onclick="deleteMessage(' . $message['MESSAGE_ID'] . ')">Supprimer</button>';
            echo '</div>';
            echo '</div>';
        }
    }
    echo '</div>';
    ?>
</div>
<!-- Suppression message -->
<script>
    function deleteMessage(messageId) {
        if (confirm("Voulez-vous vraiment supprimer ce message ?")) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller-delete-sent-message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send('messageId=' + messageId);
        }
    }
</script>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>