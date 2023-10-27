<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<div class="divButtonsMyMessages">
    <button id="receivedButton">Messages reçus</button>
    <button id="sentButton">Messages envoyés</button>
    <button id="newMessageButton">Nouveau message</button>
</div>
<div id="newMessage">
    <form id="newMessageForm" action="" method="POST" style="display: none;">
        <textarea id="messageContent" name="messageContent" placeholder="Saisissez votre message ici" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</div>
<!-- Affichage des messages envoyés -->
<div class="sentMessages" id="sentMessages" style="display: none;">
    <?php
    $userId = $_SESSION['user']['ID'];
    $messages = Message::getMessagesByUserId($userId);
    echo '<div class = "sentMessageDivTest">';
    foreach ($messages as $message) {
        // htmlspecialchars pour prevenir les failles XSS (injection de code dans les champs de formulaire)
        echo  '<div class = "sentMessageDiv">';
        echo '<p>' . htmlspecialchars($message['MESSAGE_CONTENT'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>' . "Envoyé le " . htmlspecialchars($message['MESSAGE_DATE'] = date("d/m/Y", strtotime($message['MESSAGE_DATE'])), ENT_QUOTES, 'UTF-8') . " à " . htmlspecialchars($message['MESSAGE_TIME'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<button onclick="deleteMessage(' . $message['MESSAGE_ID'] . ')">Supprimer</button>';
        echo '</div>';
    }
    echo '</div>';
    ?>
</div>
<div id="messageContainer"></div>
<!-- Script pour gérer les fragments d'URL -->
<script>
    // Fonction pour mettre à jour l'URL et le contenu
    function updateURLAndContent(fragment) {
        window.location.hash = fragment; // Met à jour le fragment d'URL
        loadContent(fragment); // Met à jour le contenu en fonction du fragment
    }
    // Fonction pour charger le contenu en fonction du fragment
    function loadContent(fragment) {
        var messageContainer = document.getElementById('messageContainer');
        if (fragment === '#sent') {
            messageContainer.innerHTML = 'Contenu des messages envoyés...';
        } else if (fragment === '#received') {
            messageContainer.innerHTML = 'Contenu des messages reçus...';
        } else if (fragment === '#newMessage') {
            messageContainer.innerHTML = 'Création du nouveau message...';
        } else {
            messageContainer.innerHTML = 'Contenu par défaut...';
        }
    }
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
            // Afficher la section des messages envoyés
            document.getElementById('sentMessages').style.display = 'block';
            document.getElementById('newMessageForm').style.display = 'none';

        } else if (fragment === '#received') {
            // Afficher la section des messages reçus
            document.getElementById('sentMessages').style.display = 'none';

        } else if (fragment === '#newMessage') {
            // Afficher la section de création d'un nouveau message
            document.getElementById('sentMessages').style.display = 'none';
            document.getElementById('newMessageForm').style.display = 'block';

        } else {
            // Par défaut, afficher la section des messages reçus ou tout autre contenu par défaut
            document.getElementById('sentMessages').style.display = 'none';
            // Vous pouvez gérer d'autres sections ici si nécessaire
        }
    }

    // Vérifier le fragment d'URL au chargement de la page
    window.addEventListener('load', function() {
        loadContentFromHash();
    });

    // Vérifier le fragment d'URL en cas de changement
    window.addEventListener('hashchange', function() {
        loadContentFromHash();
    });

    // Appeler la fonction de chargement lors de l'ouverture de la page
    loadContentFromHash();

    // Fonction pour supprimer un message
    function deleteMessage(messageId) {
        if (confirm("Voulez-vous vraiment supprimer ce message ?")) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller-delete-sent-message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // La suppression a réussi, rafraîchissez la page
                    location.reload();
                }
            };
            xhr.send('messageId=' + messageId);
        }
    }
</script>
<?php require_once "components/footer.php" ?>