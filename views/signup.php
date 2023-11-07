<?php session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-home.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- FORMULAIRE D'INSCRIPTION -->
<form class="myform" method="post">
    <?php echo $errorform; ?>
    <!-- Nom -->
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input class="form-control" name="USER_LASTNAME" value="<?php echo htmlspecialchars($USER_LASTNAME) ?>">
        <?php echo $lastnameError; ?>
    </div>
    <!-- Prénom -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Prénom</label>
        <input class="form-control" name="USER_FIRSTNAME" value="<?php echo htmlspecialchars($USER_FIRSTNAME) ?>">
        <?php echo $firstnameError; ?>
    </div>
    <!-- Adresse mail -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="USER_MAIL" value="<?php echo htmlspecialchars($USER_MAIL) ?>">
        <?php echo $mailError; ?>
    </div>
    <!-- Téléphone -->
    <div class="mb-3">
        <label for="USER_PHONE" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="USER_PHONE" id="USER_PHONE" value="<?php echo htmlspecialchars($USER_PHONE) ?>">
        <?php echo $phoneError; ?>
    </div>
    <!-- Mot de passe -->
    <label for="motdepasse" class="form-label">Mot de passe</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control" id="motdepasse" aria-label="Amount (to the nearest dollar)" name="USER_PASSWORD">
        <span class="input-group-text" onclick="displayPassword()"><i class="bi bi-eye-fill"></i></span>
    </div>
    <?php echo $passwordError; ?>

    <!-- Force mot de passe -->
    <div class="power" id="power">
        <div class="secure" id="secure"></div>
        <div class="message" id="message"></div>
    </div>
    <!-- Confirmation mot de passe -->
    <label for="motdepasse" class="form-label">Confirmer le mot de passe</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control" id="USER_PASSWORD_CONFIRM" aria-label="Amount (to the nearest dollar)" name="USER_PASSWORD_CONFIRM">
        <span class="input-group-text" onclick="displayConfirmPassword()"><i class="bi bi-eye-fill"></i></span>
        <?php echo $passwordConfirmError; ?>
    </div>
    <!-- Boutons connexion & inscription -->
    <div class="signup-buttons">
        <!-- Bouton Retour à l'accueil -->
        <div class="div-register-buttons">
            <a href="../../Coiffadom/controllers/controller-home.php">
                <button type="button" class="signup-home-button">Retour à l'accueil</button>
            </a>
        </div>
        <!-- Bouton Se connecter -->
        <div class="div-register-buttons">
            <a href="../../Coiffadom/controllers/controller-login.php">
                <button type="button" class="signup-return-button">Se connecter</button>
            </a>
            <p class="noaccount">Vous avez un compte !</p>
        </div>
        <!-- Bouton S'inscrire -->
        <div class="div-register-buttons">
            <button type="submit" name="submit" class="signup-register-button">S'inscrire</button>
        </div>
    </div>
</form>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>