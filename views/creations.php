<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<?php
echo '<div class="row mx-0 haircutRow">';
$haircut = Haircut::getHaircuts();
foreach ($haircut as $file) {
    echo '<div class="card col-md-6 col-sm-12 col-lg-4 my-3">';
    echo '<img class="image card-img-top" src="../../Coiffadom/assets/img/haircuts/' . $file['HAIRCUT_IMG_NAME'] . '" alt="coupe" width="200px">';
    echo '<p class="creationsImgDescription">';
    echo $file['HAIRCUT_IMG_DESCRIPTION'];
    echo '</p>';
    echo '</div>';
}
echo '</div>';
?>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>