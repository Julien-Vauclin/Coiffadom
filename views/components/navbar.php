<?php
if (isset($_SESSION['user'])) {
    $upperButtonText = "Mon compte";
    $upperButtonLink = "../../../Coiffadom/controllers/controller-myaccount.php";
    $lowerButtonText = "Déconnexion";
    $lowerButtonLink = "../../../Coiffadom/controllers/controller-logout.php";
} else {
    $upperButtonText = "Connexion";
    $upperButtonLink = "../../../Coiffadom/controllers/controller-login.php";
    $lowerButtonText = "Inscription";
    $lowerButtonLink = "../../../Coiffadom/controllers/controller-signup.php";
}
?>
<nav>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="container-fluid mynavbar">
            <!-- Logo -->
            <div class="logodesktop">
                <a class="navbar-brand" href="../../../Coiffadom/controllers/controller-home.php"><img src="../assets/img/coiffadom-logo.png" alt="Logo Céline Coiff' à Dom" class="navbarlogo"></a>
            </div>
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="logomobile">
                <a class="navbar-brand" href="../../../Coiffadom/controllers/controller-home.php"><img src="../assets/img/coiffadom-logo.png" alt="Logo Céline Coiff' à Dom" class="navbarlogo"></a>
            </div>
            <!-- Menu offcanvas -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarScroll" aria-labelledby="navbarScrollLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarScrollLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Les liens de navigation -->
                    <ul class="navbar-nav">
                        <!-- Verif admin -->
                        <?php
                        if (isset($_SESSION['user']) && ($_SESSION['user']['USER_ADMIN'] == 1)) {
                            echo "<li class='nav-item'><a class='nav-link' href='../../../Coiffadom/controllers/controller-admin-booking.php'>Voir les RDV</a></li>";
                        } else {
                            echo "<li class='nav-item'><a class='nav-link' href='../../../Coiffadom/controllers/controller-booking.php'>Prendre RDV</a></li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../Coiffadom/controllers/controller-about-me.php">À propos de moi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../Coiffadom/controllers/controller-creations.php">Créations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../Coiffadom/controllers/controller-prices.php">Tarifs</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Nom & Prénom -->
            <div class="nometprenom">
                <?php if (isset($_SESSION['user'])) {
                    echo "Bonjour " . "&nbsp;" . "<b>" . $_SESSION['user']['USER_FIRSTNAME'] . " " . $_SESSION['user']['USER_LASTNAME'] . "</b>";
                }
                ?>
            </div>
            <!-- Bouton Connexion/Inscription -->
            <div class="div-navbar-login-button custom-select">
                <button id="select-button" class="navbar-login-button select-button">
                    <span class="bi bi-person-circle"></span>
                    <span class="select-label"></span>
                </button>
                <!-- Menu déroulant -->
                <ul id="select-options" class="navbar-login-button-list select-options">
                    <li data-value="<?= $upperButtonLink ?>"><?= $upperButtonText ?></li>
                    <li data-value="<?= $lowerButtonLink ?>"><?= $lowerButtonText ?></li>
                </ul>
            </div>
        </div>
    </nav>
</nav>
<script>
    // Fonction pour le menu déroulant Connexion/Inscription
    $(document).ready(function() {
        var selectButton = $('#select-button');
        var selectOptions = $('#select-options');

        selectButton.on('click', function(e) {
            e.stopPropagation();
            selectOptions.toggle();
        });

        selectOptions.on('click', 'li', function() {
            var selectedValue = $(this).data('value');
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        });
        // Fonction qui permet de fermer le menu déroulant lorsqu'on clique à l'extérieur
        $(document).on('click', function() {
            selectOptions.hide();
        });
    });
</script>