<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<?php
echo "<div class='personalInfos' id='personalInfos'>";
echo "<div class='divPersonalInfos'>";
echo "<p class='textPersonalInfos'><b>Mail: </b>{$_SESSION['user']['USER_MAIL']}<button class='updateInfosButton' onclick='updateInfosUser'>Modifier</button></p><br>";
echo "<p class='textPersonalInfos'><b>Prénom: </b>{$_SESSION['user']['USER_FIRSTNAME']}<button class='updateInfosButton' onclick='updateInfosUser'>Modifier</button></p><br>";
echo "<p class='textPersonalInfos'><b>Nom: </b>{$_SESSION['user']['USER_LASTNAME']}<button class='updateInfosButton' onclick='updateInfosUser'>Modifier</button></p><br>";
echo "<p class='textPersonalInfos'><b>Téléphone: </b>{$_SESSION['user']['USER_PHONE']}<button class='updateInfosButton' onclick='updateInfosUser'>Modifier</button></p><br>";
echo "</div>";
echo "</div>";
if (isset($_SESSION['user']['USER_MAIL'])) {
    $infosUser = User::getInfosUser($_SESSION['user']['USER_MAIL']);
}
?>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>