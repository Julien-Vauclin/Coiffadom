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
        $firstnameError = "<p class='invalid'>Le prénom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
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
<?php
?>