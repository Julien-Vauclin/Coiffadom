<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<?php
echo "<form class='formPersonalInfos' method='post'>";
echo "<div class='personalInfos' id='personalInfos'>";
echo "<div class='divPersonalInfos'>";
echo "<p class='textPersonalInfos'><b>Prénom: </b><input name='USER_FIRSTNAME' class='inputPersonalInfos' value='{$_SESSION['user']['USER_FIRSTNAME']}'></p><br>";
echo $USER_FIRSTNAME_ERROR;
echo "<p class='textPersonalInfos'><b>Nom: </b><input name='USER_LASTNAME' class='inputPersonalInfos' value='{$_SESSION['user']['USER_LASTNAME']}'></p><br>";
echo $USER_LASTNAME_ERROR;
echo "<p class='textPersonalInfos'><b>Téléphone: </b><input name='USER_PHONE' class='inputPersonalInfos' value='{$_SESSION['user']['USER_PHONE']}'></p><br>";
echo $USER_PHONE_ERROR;
echo $USER_FORM_ERROR;
echo "</div>";
echo "</div>";
echo "<div class='divUpdateButtonPersonalInfos'>";
echo "<a href='../../Coiffadom/controllers/controller-myaccount.php'><button class='returnButtonPersonalInfos' type='button'>Retour</button></a>";
echo "<button class='updateButtonPersonalInfos' type='submit' name='submit'>Modifier</button>";
echo "</div>";
echo "</form>";
if (isset($_SESSION['user']['USER_MAIL'])) {
    $infosUser = User::getInfosUser($_SESSION['user']['USER_MAIL']);
}
?>
<!-- Confirmation de la modification des informations personnelles -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var updateButtonPersonalInfos = document.querySelector(".updateButtonPersonalInfos");
        updateButtonPersonalInfos.addEventListener("click", function(event) {
            if (!confirm("Voulez-vous vraiment modifier vos informations personnelles ?")) {
                event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler".
            }
        });
    });
</script>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>