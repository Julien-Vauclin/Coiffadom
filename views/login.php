<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<form class="formulaire" action="" method="post">
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
        <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherPassword()"></i></span>
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
    <div class="boutonslogin">
        <!-- Bouton connexion -->
        <div class="boutonconnexionemploye">
            <button class="connexionemploye" type="submit" name="submit">Connexion</button>
        </div>
        <!-- Bouton inscription -->
        <div class="boutoninscriptionemploye">
            <a href="../../Coiffadom/controllers/controller-signup.php">
                <button type="button" class="inscriptionemploye">Inscription</button>
            </a>
            <p class="pasdecompte">Vous n'avez pas de compte ?</p>
        </div>
    </div>
</form>
<?php require_once "components/footer.php" ?>