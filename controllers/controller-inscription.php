<?php
require_once "../config.php";
require_once "../models/user.php";
require_once "../helpers/database.php";
// VARIABLES
// Variables pour stocker les valeurs des champs du formulaire
$lastname = $firstname = $mail = $phone = $password =  $passwordConfirm = "";
// Variables pour stocker les messages d'erreur
$lastnameError = $firstnameError = $mailError = $phoneError = $passwordError = $passwordConfirmError = "";
// REGEX
// Définition de la variable de sécurité pour les Regex
$securityLevel = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $passwordConfirm = $_POST['passwordConfirm'];
    // Récupération des données du formulaire
    $nomInscrit = $_POST['lastname'];
    $prenomInscrit = $_POST['firstname'];
    $mailInscrit = $_POST['mail'];
    $numeroTelephone = $_POST['phone'];
    $motDePasse = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    // Définition des regex
    $regexLastname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexFirstname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexMail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/';
    $regexPhone = '/^(06|07)\d{8}$/';
    // Fonction lastname (regex)
    if ($nomInscrit === "") {
        $lastnameError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexLastname, $nomInscrit)) {
        $lastnameError = "";
    } else {
        $lastnameError = "<p class='invalid'>Le nom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
    };
    // Fonction firstname (regex)
    if ($prenomInscrit === "") {
        $firstnameError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexFirstname, $prenomInscrit)) {
        $firstnameError = "";
    } else {
        $firstnameError = "<p class='invalid'>Le prénom est invalide.</p>";
    };
    // Fonction mail (regex)
    if ($mailInscrit === "") {
        $mailError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexMail, $mailInscrit)) {
        $mailError = "";
    } else {
        $mailError = "<p class='invalid'>L'adresse mail est invalide.</p>";
    };
    // Fonction phone (regex)
    if ($numeroTelephone === "") {
        $phoneError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexPhone, $numeroTelephone)) {
        $phoneError = "";
    } else {
        $phoneError = "<p class='invalid'>Le numéro de téléphone est invalide.</p>";
    };
    // Fonction password
    if ($motDePasse !== $passwordConfirm) {
        $passwordError = "<p class='invalid'>Les mots de passe doivent être identiques.</p>";
    } else {
        // Vérification de la force du mot de passe (au moins "moyen")
        if (preg_match('/[a-z]/', $motDePasse)) {
            $securityLevel++;
        }
        if (preg_match('/[A-Z]/', $motDePasse)) {
            $securityLevel++;
        }
        if (preg_match('/[0-9]/', $motDePasse)) {
            $securityLevel++;
        }
        if (preg_match('/[@?!$]/', $motDePasse)) {
            $securityLevel++;
        }
        if (strlen($motDePasse) >= 8) {
            $securityLevel++;
        }
        if ($securityLevel == 0) {
            $passwordError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        } else if ($securityLevel < 2) {
            $passwordError = "<p class='invalid'>Mot de passe trop dangereux.</p>";
        } else {
            $passwordError = "";
        }
        if ($lastnameError !== "" || $firstnameError !== "" || $mailError !== "" || $phoneError !== "" || $passwordError !== "") {
            echo "<p class='invalid'>Veuillez corriger les erreurs avant d'envoyer le formulaire.</p>";
        } else {
            try {
                $db = new Database();
                $pdo = $db->createInstancePDO();

                $sql = "SELECT COUNT(*) AS count FROM employee WHERE mail = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$mail]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result['count'] > 0) {
                    echo "<p class='invalid'>L'adresse e-mail existe déjà dans la base de données.</p>";
                } else {
                    // Insertion dans la base de données
                    $sql = "INSERT INTO employee (lastname, firstname, mail, phone, password) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$lastname, $firstname, $mail, $phone, $hashedPassword]);

                    echo "L'employé a bien été ajouté. (inscription.php)";
                    echo '<script>window.alert("Bienvenue ' . $firstname . ' ,vous êtes inscrit(e) !");
            window.location.href = "../controllers/controller-login-employe.php";
            </script>';
                }
            } catch (PDOException $exception) {
                echo "Erreur lors de l'ajout de l'employé : " . $exception->getMessage() . "<br>";
            }
        }
    }
}
?>
<!-- TEST -->
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
        <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherPassword()"></i></span>
    </div>
    <?php echo $passwordError; ?>
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
    <!-- Script pour la force du mot de passe -->
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
        <input type="password" class="form-control" id="passwordConfirm" aria-label="Amount (to the nearest dollar)" name="passwordConfirm">
        <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherConfirmationPassword()"></i></span>
        <?php echo $passwordConfirmError; ?>
    </div>
    <!-- Confirmation mot de passe affichage-->
    <script>
        function afficherConfirmationPassword() {
            var x = document.getElementById("passwordConfirm");
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