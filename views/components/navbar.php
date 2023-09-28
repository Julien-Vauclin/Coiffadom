<nav>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="container-fluid mynavbar">
            <!-- Logo -->
            <a id="caca" class="navbar-brand" href="../../../Coiffadom/controllers/controller-home.php"><img src="../assets/img/outils-de-cheveux.png" alt="Logo Céline Coiff' à Dom" class="navbarlogo">Céline Coiff' à Dom</a>
            <!-- 1ère loupe -->
            <button class="loupe1" onclick="openSearchPopup()"><span class="bi bi-search"></span></button>
            <div class="search-popup">
                <div class="search-content">
                    <div class="search-bar">
                        <input type="text" placeholder="Rechercher..." class="rechercher">
                        <button onclick="closeSearchPopup()">Fermer</button>
                    </div>
                </div>
            </div>
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu offcanvas -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarScroll" aria-labelledby="navbarScrollLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarScrollLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Les liens de navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Prendre RDV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">À propos de moi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Créations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tarifs</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 2ème loupe -->
            <button class="loupe2" onclick="openSearchPopup()"><span class="bi bi-search"></span></button>
            <div class="search-popup">
                <div class="search-content">
                    <div class="search-bar">
                        <input type="text" placeholder="Rechercher..." class="rechercher">
                        <button onclick="closeSearchPopup()">Fermer</button>
                    </div>
                </div>
            </div>
            <!-- Bouton Connexion/Inscription -->
            <div class="div-navbar-login-button custom-select">
                <button id="select-button" class="navbar-login-button select-button">
                    <span class="bi bi-person-circle"></span>
                    <span class="select-label"></span>
                </button>
                <!-- Menu déroulant -->
                <ul id="select-options" class="navbar-login-button-list select-options">
                    <li data-value="../../../Coiffadom/controllers/controller-login.php">Connexion</li>
                    <li data-value="../../Coiffadom/controllers/controller-signup.php">Inscription</li>
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
    Fonction
</script>