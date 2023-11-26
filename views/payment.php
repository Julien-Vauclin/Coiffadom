<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<div class="mymessagesSentMessageDiv">
    <p class="mymessagesSentMessageText" style="text-align: center; font-size: 46px;">COMING SOON ... <br><span style=" font-size: 26px;">Cette page est en cours de construction, merci de votre patience !</span></p>
</div>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>