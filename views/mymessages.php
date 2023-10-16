<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<p>
    <button id="receivedButton">Messages reçus</button>
    <button id="sentButton">Messages envoyés</button>
</p>
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
        }
    }

    // Bouton "Messages reçus"
    document.getElementById('receivedButton').addEventListener('click', function() {
        updateURLAndContent('#received');
    });

    // Bouton "Messages envoyés"
    document.getElementById('sentButton').addEventListener('click', function() {
        updateURLAndContent('#sent');
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
<?php require_once "components/footer.php" ?>