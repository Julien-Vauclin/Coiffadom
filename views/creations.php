<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<?php if (isset($_SESSION['user']) && ($_SESSION['user']['USER_ADMIN'] == 1)) {
    echo '<form action="" method="post" enctype="multipart/form-data">';
    echo '<label for="image">Sélectionner une image :</label>';
    echo '<input type="file" name="image" id="image" accept="image/*">';
    echo '<button type="submit">Envoyer</button>';
    echo '</form>';
};
?>

<script>
</script>
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