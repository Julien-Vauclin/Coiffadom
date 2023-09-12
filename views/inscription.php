<?php require_once "components/navbar.php" ?>
<?php require_once "components/head.php" ?>
<?php require_once "../controllers/controller-inscription.php" ?>
<!-- FORMULAIRE D'INSCRIPTION -->
<form class="formulaire" method="post" onsubmit="return validateForm()">
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
    <div class="boutonslogin">
        <div class="divboutonaccueillogin">
            <a href="login-employe.php">
                <button type="button" class="boutonaccueillogin">Retour</button>
            </a>
        </div>
        <!-- Bouton inscription -->
        <div class="boutonconnexionemploye">
            <button type="submit" name="submit" class="sinscrire">S'inscrire</button>
        </div>
    </div>
</form>
<!-- SCRIPT -->
<!-- Affichage mot de passe -->
<script>
    function displayPassword() {
        var x = document.getElementById("motdepasse");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<!-- Affichage confirmation mot de passe -->
<script>
    function displayConfirmPassword() {
        var x = document.getElementById("passwordConfirm");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<!-- Force du mot de passe -->
<script>
    // Variables
    var motdepasse = document.getElementById('motdepasse');
    var compteur = 0;
    var secure = document.getElementById('secure');
    // Regex
    let regexMini = new RegExp('[a-z]');
    let regexMaj = new RegExp('[A-Z]');
    let regexNombre = new RegExp('[0-9]');
    let regexSpec = new RegExp('[@?!$]');
    // Niveaux de sécurité
    motdepasse.addEventListener('input', function() {
        let security = 0;
        if (regexMini.test(motdepasse.value)) {
            security++;
        }
        if (regexMaj.test(motdepasse.value)) {
            security++;
        }
        if (regexNombre.test(motdepasse.value)) {
            security++;
        }
        if (regexSpec.test(motdepasse.value)) {
            security++;
        }
        if (motdepasse.value.length >= 8) {
            security++;
        }
        // fonction changement texte
        if (security == 0) {
            secure.innerHTML = '<p>Inexistant</p>';
        } else if (security == 1) {
            secure.innerHTML = '<p style="color: red">Dangereux</p>';
        } else if (security == 2) {
            secure.innerHTML = '<p style="color: orange">Moyen</p>';
        } else if (security == 3) {
            secure.innerHTML = '<p style="color: gold">Sécurisé</p>';
        } else if (security == 4) {
            secure.innerHTML =
                '<p style="color: lime">Très sécurisé</p>';
        } else if (security == 5) {
            secure.innerHTML =
                '<p style="color: deeppink">Ultra sécurisé !</p>';
        }
    });
</script>
<?php require_once "components/footer.php" ?>