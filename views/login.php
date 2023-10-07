<?php session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-home.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<form class="myform" action="" method="post">
    <!-- Adresse mail -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse e-mail</label>
        <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" name="mail" value="<?= isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '' ?>">
        <?= $msgMail ?? "" ?>
    </div>
    <!-- Mot de passe -->
    <label for="motdepasse" class="form-label">Mot de passe</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control" id="motdepasse" aria-label="Amount (to the nearest dollar)" name="password">
        <span class="input-group-text" onclick="afficherPassword()"><i class="bi bi-eye-fill"></i></span>
    </div>
    <?= $msgMdp ?? "" ?>
    <!-- Affichage mot de passe -->
    <script>
        function afficherPassword() {
            var x = document.getElementById("motdepasse");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script>
        function connexionemploye() {
            window.location.href = "../controllers/controller-espace-employe.php";
        }
    </script>
    <!-- Boutons connexion & inscription -->
    <div class="signup-buttons">
        <!-- Bouton connexion -->
        <div class="div-register-buttons">
            <button class="login-connexion-button" type="submit" name="submit">Connexion</button>
        </div>
        <!-- Bouton inscription -->
        <div class="div-register-buttons">
            <a href="../../Coiffadom/controllers/controller-signup.php">
                <button class="login-signup-button" type="button">Inscription</button>
            </a>
            <p class="noaccount">Vous n'avez pas de compte ?</p>
        </div>
    </div>
</form>
<!-- TEST CONNEXION -->
<?php
if (isset($_SESSION['user'])) {
    $firstname = $_SESSION['user']['firstname'];
    $lastname = $_SESSION['user']['lastname'];
    $welcomeMessage = "Bienvenue $firstname $lastname !";
    echo "<p>$welcomeMessage</p>";
} else {
    $notLoggedMessage = "Vous n'êtes pas connecté(e)";
    echo "<p>$notLoggedMessage</p>";
    exit();
    session_destroy();
}
?>
<!-- FIN TEST CONNEXION -->
<?php require_once "components/footer.php" ?>