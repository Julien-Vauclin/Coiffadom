<nav>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="container-fluid mynavbar">
            <a class="navbar-brand" href="#"><img src="../assets/img/outils-de-cheveux.png" alt="Logo Céline Coiff' à Dom" class="navbarlogo">Céline Coiff' à Dom</a>
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
                            <a class="nav-link" href="#">Page 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page 3</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page 4</a>
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
            <!-- Bouton connexion/inscription -->
            <button class="connexion">Connexion/Inscription</button>
        </div>
    </nav>
</nav>