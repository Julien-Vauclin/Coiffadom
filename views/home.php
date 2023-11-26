<?php session_start(); ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Carousel -->
<div class="mycarousel">
    <div class="carouselBody">
        <div id="carouselExampleCaptions" class="carousel slide col-8">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner slide">
                <div class="carousel-item active">
                    <img src="../../Coiffadom/assets/img/haircuts/coupe1.jpg" class="d-block w-100 imgcarousel" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="titrecarousel">Balayage</h5>
                        <p>Un balayage naturel comme on les aime. Balayage doré sur base naturelle.</p>
                        <a href="../../Coiffadom/controllers/controller-creations.php"><button class="buttonCarousel">Voir plus</button></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../../Coiffadom/assets/img/haircuts/coupe2.jpg" class="d-block w-100 imgcarousel" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="titrecarousel">Coloration</h5>
                        <p>Cette cliente a osé ! Le changement de coupe et de couleur à l'approche de l'automne.</p>
                        <a href="../../Coiffadom/controllers/controller-creations.php"><button class="buttonCarousel">Voir plus</button></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../../Coiffadom/assets/img/haircuts/coupe3.jpg" class="d-block w-100 imgcarousel" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="titrecarousel">Permanente</h5>
                        <p>Mise à jour pour cette magnifique couleur cuivrée rehaussée d’un balayage contouring.</p>
                        <a href="../../Coiffadom/controllers/controller-creations.php"><button class="buttonCarousel">Voir plus</button></a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<!--Fin carousel-->
<!-- Script défilement automatique carousel -->
<script>
    function autoScroll() {
        $('#carouselExampleCaptions').carousel('next');
    }
    setInterval(autoScroll, 7000);
</script>
<!-- Fin script défilement automatique carousel -->
<!-- Actus -->
<div style="margin:0 auto; width:51%;">
    <p style="font-size: 32px; text-align:center; margin-top:55px; background-color:#B4918F; border-radius:8px; font-weight:bold;">ACTUALITÉS</p>
</div>
<div class="divActusHome" style="text-align: center;">
    <p style="text-align: center;">Les vacances de Noël approchent à grand pas ! Vacances prévues du <b>Samedi 16 Décembre</b> jusqu'au <b>Lundi 8 Janvier.</b><br><br><span style="font-size: 25px;">Bonnes fêtes à toutes & à tous !</span></p>
</div>
<!-- Bienvenue -->
<div style="margin:0 auto; width:51%;">
    <p style="font-size: 27px; text-align:center; margin-top:55px; background-color:#B4918F; border-radius:8px; font-weight:bold;">Bienvenue sur le site internet Colorée par Céline !</p>
</div>
<div class="divAboutMeHome">
    <p class="textHomePage" style="font-size: 16px; width:80%;">Découvrez le parcours captivant d'une coiffeuse passionnée depuis l'obtention de son CAP en 1996. Après huit ans en gestion de salon et un an et demi à gérer deux salons simultanément, elle a fait le choix audacieux de devenir coiffeuse indépendante en 2017. Son style distinctif, mêlant tradition et innovation, témoigne de sa créativité et de son leadership. Explorez son aventure depuis 2017 pour une expérience unique dans le monde de la coiffure à domicile.</p>
    <a class="buttonHomePage" href="../../Coiffadom/controllers/controller-about-me.php"><button class="buttonCarousel">À propos de moi</button></a>
    <img class="logoHomePage" src="../../Coiffadom/assets/img/aboutmelogo.png" alt="" height="1%" width="3%">
</div>
<a class="buttonHomePageMobile" href="../../Coiffadom/controllers/controller-about-me.php"><button class="buttonCarousel">À propos de moi</button></a>
<div class="divPricesHome">
    <img class="logoHomePage" src="../../Coiffadom/assets/img/pricelogo.png" alt="" height="1%" width="3%">
    <a class="buttonHomePage" href="../../Coiffadom/controllers/controller-prices.php"><button class="buttonCarousel">Tarifs</button></a>
    <p class="textHomePage" style="font-size: 16px; width:80%;">Explorez notre univers de beauté capillaire avec une grille tarifaire qui promet une métamorphose capillaire personnalisée. Optez pour une coupe et un brushing pour révéler votre style unique, ou laissez-vous tenter par l'éclat d'un balayage ou de mèches habilement réalisés. Nos tarifs vous offrent l'accès à une palette de coiffures tendance et sophistiquées. Découvrez la page des tarifs pour trouver la formule parfaite qui mettra en lumière votre beauté naturelle.</p>
</div>
<a class="buttonHomePageMobile" href="../../Coiffadom/controllers/controller-prices.php"><button class="buttonCarousel">Tarifs</button></a>
<div class="divBookingHome">
    <p class="textHomePage" style="font-size: 19px; width:80%;">Vous souhaitez prendre rendez-vous ? N'hésitez plus ! Prenez votre rendez-vous en 1 minute chrono. Choisissez la prestation souhaitée, votre longueur de cheveux, la date et l'heure souhaitée, puis validez votre rendez-vous.</p>
    <a class="buttonHomePage" href="../../Coiffadom/controllers/controller-booking.php"><button class="buttonCarousel">Rendez-vous</button></a>
    <img class="logoHomePage" src="../../Coiffadom/assets/img/meetinglogo.png" alt="" height="1%" width="3%">
</div>
<a class="buttonHomePageMobile" href="../../Coiffadom/controllers/controller-booking.php"><button class="buttonCarousel">Rendez-vous</button></a>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>