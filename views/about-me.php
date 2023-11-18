<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<div class="aboutmeDiv">
    <p class="aboutmeTitle">Mon parcours</p>
    <p class="aboutmeText">Ayant obtenu mon CAP coiffure en 1996, j'ai tracé mon chemin avec passion et engagement, développant au fil des ans un savoir-faire qui m'a permis d'évoluer.<br><br>
        Perfectionnant continuellement mes compétences dans divers salons, j'ai occupé le poste de gestionnaire d'un salon pendant huit années enrichissantes, puis ai assumé la gestion de deux salons simultanément pendant un an et demi.<br><br>
        En 2017, j'ai fait le choix de devenir coiffeuse indépendante, marquant ainsi une nouvelle étape dans ma carrière. Libre de créer et d'exprimer mon style, j'ai embrassé l'indépendance avec enthousiasme.<br><br>
        Mon parcours professionnel est une histoire faite de réussites et de défis surmontés. En tant que coiffeuse, je m'efforce d'incarner la passion et la persévérance caractéristiques de ceux qui aiment véritablement l'art de la coiffure.<br><br>
        Fortement influencée par mes expériences variées, j'ai développé un style distinctif, alliant avec habileté tradition et innovation. Mon passage en tant que manager et ma transition réussie vers l'indépendance témoignent de ma vision évolutive et de ma détermination constante.<br><br>
        Mon parcours professionnel est une aventure captivante, marquée par la créativité, le sens du leadership et le désir d'indépendance. Depuis 2017, en tant que coiffeuse indépendante, je m'efforce de laisser une empreinte positive dans le domaine de la coiffure, offrant à mes clients une expérience unique et personnalisée.</p>
</div>
<?php if (isset($_SESSION['user']) && ($_SESSION['user']['USER_ADMIN'] == 1)) {
}

?>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>