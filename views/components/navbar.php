<nav>
    <!-- Toggler -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="container-fluid mynavbar">
            <a class="navbar-brand" href="#"><img src="../assets/img/outils-de-cheveux.png" alt="Logo Céline Coiff' à Dom" class="navbarlogo">Céline Coiff' à Dom</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
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
                <button class="loupe" onclick="openSearchPopup()"><span class="bi bi-search"></span></button>

                <div class="search-popup">
                    <div class="search-content">
                        <div class="search-bar">
                            <input type="text" placeholder="Rechercher..." class="rechercher">
                            <button onclick="closeSearchPopup()">Fermer</button>
                        </div>
                    </div>
                </div>
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Ex: Tarifs, Photos..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form> -->
            </div>
        </div>
    </nav>
    <!-- Fin toggler -->
</nav>