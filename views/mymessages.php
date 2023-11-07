<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<div class="divButtonsMyMessages">
    <button id="receivedButton" class="receivedButton">Messages reçus</button>
    <button id="sentButton" class="sentButton">Messages envoyés</button>
    <button id="newMessageButton" class="newMessageButton">Nouveau message</button>
</div>
<div id="newMessage">
    <form id="newMessageForm" class="newMessageForm" method="POST" style="display: none;">
        <div class="textareaNewMessage">
            <textarea id="messageContent" class="messageContent" name="messageContent" placeholder="Saisissez votre message ici" required></textarea>
            <button type="submit" class="sendButtonNewMessage">Envoyer</button>
        </div>
    </form>
</div>
<!-- Affichage des messages envoyés -->
<div class="sentMessages" id="sentMessages" style="display: none;">
    <?php
    $userId = $_SESSION['user']['ID'];
    $messages = Message::getMessagesByUserId($userId);
    if (empty($messages)) {
        echo '<div class = "mymessagesSentMessageDiv">';
        echo '<p class = "mymessagesSentMessageText" style = "text-align: center; font-size: 26px;">' . "Vous n'avez pas encore envoyé de message." . '</p>';
        echo '</div>';
    } else {
        echo '<div class = "mymessagesSentMessageDiv">';
        foreach ($messages as $message) {
            // htmlspecialchars pour prevenir les failles XSS (injection de code dans les champs de formulaire)
            echo  '<div class = "sentMessageDiv">';
            echo '<p class = "mymessagesSentMessageText">' . htmlspecialchars($message['MESSAGE_CONTENT'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<div class = "dateAndDeleteButton">';
            echo '<p class = "dateSentMessage">' . "Envoyé le " . htmlspecialchars($message['MESSAGE_DATE'] = date("d/m/Y", strtotime($message['MESSAGE_DATE'])), ENT_QUOTES, 'UTF-8') . " à " . htmlspecialchars($message['MESSAGE_TIME'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<button class="mymessagesSentDeleteButton" onclick="deleteMessage(' . $message['MESSAGE_ID'] . ')">Supprimer</button>';
            echo '</div>';
            echo '</div>';
        }
    }
    echo '</div>';
    ?>
</div>
<!-- Affichage des messages reçus -->
<div class="receivedMessage" id="receivedMessage" style="display: none;">
    <?php
    $userId = $_SESSION['user']['ID'];
    // Le reste de la fonction ici ...
    echo '<div class = "sentMessageDiv"></div>';
    ?>
</div>
<!-- Script pour gérer les fragments d'URL -->
<script>
    // Fonction pour mettre à jour l'URL et le contenu
    function updateURLAndContent(fragment) {
        window.location.hash = fragment; // On met le fragment d'URL à jour
        loadContent(fragment); // On met le contenu à jour en fonction du fragment d'URL
    }
    // Fonction pour charger le contenu en fonction du fragment
    function loadContent(fragment) {}
    // Bouton "Messages reçus"
    document.getElementById('receivedButton').addEventListener('click', function() {
        updateURLAndContent('#received');
        newMessageForm.style.display = 'none';
        document.getElementById('sentMessages').style.display = 'none';
    });
    // Bouton "Messages envoyés"
    document.getElementById('sentButton').addEventListener('click', function() {
        updateURLAndContent('#sent');
        newMessageForm.style.display = 'none';
        document.getElementById('sentMessages').style.display = 'block';
    });
    // Bouton "Nouveau message"
    document.getElementById('newMessageButton').addEventListener('click', function() {
        var currentFragment = window.location.hash;
        if (currentFragment !== '#newMessage') {
            updateURLAndContent('#newMessage');
        }
        newMessageForm.style.display = 'block';
        document.getElementById('sentMessages').style.display = 'none';
    });

    // Vérifier le fragment d'URL au chargement de la page
    window.addEventListener('load', function() {
        var fragment = window.location.hash;
        loadContent(fragment);
    });
    // Vérifier le fragment d'URL en cas de changement
    window.addEventListener('hashchange', function() {
        var fragment = window.location.hash;
        loadContent(fragment);
    });
</script>
<script>
    document.getElementById('newMessageForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire par défaut
        var messageContent = document.getElementById('messageContent').value;
        // Effectuez une requête AJAX pour envoyer le message
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'controller-send-message.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Traitez la réponse du serveur (par exemple, un message de succès ou d'erreur)
                var response = xhr.responseText;
                // Mettez à jour le contenu de messageContainer avec la réponse
                document.getElementById('messageContainer').innerHTML = response;
            }
        };
        // Envoyez les données du formulaire au serveur
        var data = 'messageContent=' + encodeURIComponent(messageContent);
        xhr.send(data);
    });
</script>
<!-- Script pour la suppression des messages envoyés -->
<script>
    // Fonction pour charger le contenu en fonction du fragment d'URL
    function loadContentFromHash() {
        var fragment = window.location.hash;

        if (fragment === '#sent') {
            // On affiche les messages envoyés
            document.getElementById('sentMessages').style.display = 'block';
            document.getElementById('newMessageForm').style.display = 'none';
        } else if (fragment === '#received') {
            // On affiche les messages reçus
            document.getElementById('sentMessages').style.display = 'none';
        } else if (fragment === '#newMessage') {
            // On affiche le formulaire de création d'un nouveau message
            document.getElementById('sentMessages').style.display = 'none';
            document.getElementById('newMessageForm').style.display = 'block';
        } else {
            // Par défaut, afficher la section des messages reçus ou tout autre contenu par défaut
            document.getElementById('sentMessages').style.display = 'none';
            document.getElementById('newMessageForm').style.display = 'none';
            // Vous pouvez gérer d'autres sections ici si nécessaire
        }
    }
    // On vérifie le fragment d'URL au chargement de la page
    window.addEventListener('load', function() {
        loadContentFromHash();
    });
    // On vérifie le fragment d'URL en cas de changement
    window.addEventListener('hashchange', function() {
        loadContentFromHash();
    });
    // On appele la fonction de chargement lors de l'ouverture de la page
    loadContentFromHash();
    // Fonction pour supprimer un message
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