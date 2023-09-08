<?php
require_once "../config.php";
require_once "../models/user.php";
require_once "../helpers/database.php";
// VARIABLES
// Variables pour stocker les valeurs des champs du formulaire
$lastname = $firstname = $mail = $phone = $password =  "";
// Variables pour stocker les messages d'erreur
$lastnameError = $firstnameError = $mailError = $phoneError = $passwordError = "";
// REGEX
// Définition de la variable de sécurité pour les Regex
$securityLevel = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    // Définition des Regex
    $regexLastname = '/^[a-zA-Z]+$/';
    $regexFirstname = '/^[a-zA-Z]+$/';
    $regexMail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/';
    $regexPhone = '/^(06|07)\d{8}$/';
    // Validation des Regex pour chaque champ
    if (!preg_match($regexLastname, $lastname)) {
        $lastnameError = "Le nom est invalide.";
    }

    if (!preg_match($regexFirstname, $firstname)) {
        $firstnameError = "Le prénom est invalide.";
    }

    if (!preg_match($regexMail, $mail)) {
        $mailError = "L'adresse mail est invalide.";
    }

    if (!preg_match($regexPhone, $phone)) {
        $phoneError = "Le numéro de téléphone est invalide.";
    }

    if ($password !== $passwordConfirm) {
        $passwordError = "Les mots de passe ne correspondent pas.";
    }
    // Si toutes les validations réussissent, on peut insérer les données dans la base de données
    if ($lastnameError === "" && $firstnameError === "" && $mailError === "" && $phoneError === "" && $passwordError === "" && $password === $passwordConfirm && $securityLevel >= 2) {
        try {
            $db = new Database();
            $pdo = $db->createInstancePDO();
            // Requête SQL pour insérer les données dans la table "client"
            $sql = "INSERT INTO client (lastname, firstname, mail, phone, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nomInscrit, $prenomInscrit, $mailInscrit, $numeroTelephone, $motDePasse]);
            echo "L'employé a bien été ajouté. (inscription.php)";
        } catch (PDOException $exception) {
            echo "Erreur lors de l'ajout de l'employé : " . $exception->getMessage() . "<br>";
        }
    }
}
?>
// TEST
<form class="formulaire" method="post" onsubmit="return validateForm()">
    <!-- Nom -->
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input class="form-control" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">
        <?php echo $messageNom; ?>
    </div>
    <!-- Prénom -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Prénom</label>
        <input class="form-control" name="firstname" value="<?php echo htmlspecialchars($firstname) ?>">
        <?php echo $messagePrenom; ?>
    </div>
    <!-- Adresse mail -->
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" value="<?php echo htmlspecialchars($mail) ?>">
        <?php echo $messageMail; ?>
    </div>
    <!-- Téléphone -->
    <div class="mb-3">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($phone) ?>">
        <?php echo $messageNumero; ?>
    </div>
    <!-- Mot de passe -->
    <label for="motdepasse" class="form-label">Mot de passe</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control" id="motdepasse" aria-label="Amount (to the nearest dollar)" name="password">
        <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherPassword()"></i></span>
    </div>
    <?php echo $messagePassword; ?>
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
    <!-- Force mot de passe -->

    <div class="power" id="power">
        <div class="secure" id="secure"></div>
        <div class="message" id="message"></div>
    </div>
    <!-- Script -->
    <script>
        // variables
        var motdepasse = document.getElementById('motdepasse');
        var compteur = 0;
        var secure = document.getElementById('secure');
        // regex
        let regexMini = new RegExp('[a-z]');
        let regexMaj = new RegExp('[A-Z]');
        let regexNombre = new RegExp('[0-9]');
        let regexSpec = new RegExp('[@?!$]');
        // fonction taux de sécurité du mot de passe
        motdepasse.addEventListener('input', function() {
            let security = 0;
            if (regexMini.test(motdepasse.value)) {
                security++;
                console.log('Dangereux');
            }
            if (regexMaj.test(motdepasse.value)) {
                security++;
                console.log('Moyen');
            }
            if (regexNombre.test(motdepasse.value)) {
                security++;
                console.log('Sécurisé');
            }
            if (regexSpec.test(motdepasse.value)) {
                security++;
                console.log('Très sécurisé');
            }
            if (motdepasse.value.length >= 8) {
                security++;
                console.log('ULTRA SECURE');
            }
            console.log('security : ', security);
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
    <!-- Confirmation mot de passe -->
    <label for="motdepasse" class="form-label">Confirmer le mot de passe</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control" id="confirmationmotdepasse" aria-label="Amount (to the nearest dollar)" name="confirmationmotdepasse">
        <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherConfirmationPassword()"></i></span>
    </div>
    <!-- Confirmation mot de passe affichage-->
    <script>
        function afficherConfirmationPassword() {
            var x = document.getElementById("confirmationmotdepasse");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
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
<?php
// FIN TEST
include "../views/inscription.php";
?>