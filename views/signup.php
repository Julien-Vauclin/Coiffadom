<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- FORMULAIRE D'INSCRIPTION -->
<form class="myform" method="post" onsubmit="return validateForm()">
    <!-- Nom -->
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input class="form-control" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">
        <?php echo $lastnameError; ?>
    </div>
    <!-- Prénom -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Prénom</label>
        <input class="form-control" name="firstname" value="<?php echo htmlspecialchars($firstname) ?>">
        <?php echo $firstnameError; ?>
    </div>
    <!-- Adresse mail -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" value="<?php echo htmlspecialchars($mail) ?>">
        <?php echo $mailError; ?>
    </div>
    <!-- Téléphone -->
    <div class="mb-3">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($phone) ?>">
        <?php echo $phoneError; ?>
    </div>
    <!-- Mot de passe -->
    <label for="motdepasse" class="form-label">Mot de passe</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control" id="motdepasse" aria-label="Amount (to the nearest dollar)" name="password">
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
        <input type="password" class="form-control" id="passwordConfirm" aria-label="Amount (to the nearest dollar)" name="passwordConfirm">
        <span class="input-group-text" onclick="displayConfirmPassword()"><i class="bi bi-eye-fill"></i></span>
        <?php echo $passwordConfirmError; ?>
    </div>
    <!-- Boutons connexion & inscription -->
    <div class="signup-buttons">
        <div class="div-register-buttons">
            <a href="../../Coiffadom/controllers/controller-login.php">
                <button type="button" class="signup-return-button">Retour</button>
            </a>
        </div>
        <!-- Bouton inscription -->
        <div class="div-register-buttons">
            <button type="submit" name="submit" class="signup-register-button">S'inscrire</button>
        </div>
        <!-- Bouton retour à l'accueil -->
        <div class="div-register-buttons">
            <a href="../../Coiffadom/controllers/controller-home.php">
                <button type="button" class="signup-home-button">Retour à l'accueil</button>
            </a>
        </div>
    </div>
</form>
<!-- SCRIPT -->
<?php require_once "components/footer.php" ?>