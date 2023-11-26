<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php $errorform = ""; ?>
<?php
// VARIABLES
// Variables pour stocker les valeurs des champs du formulaire
$USER_LASTNAME = $USER_FIRSTNAME = $USER_MAIL = $USER_PHONE = $USER_PASSWORD = $USER_PASSWORD_CONFIRM = "";
// Variables pour stocker les messages d'erreur
$lastnameError = $firstnameError = $mailError = $phoneError = $passwordError = $passwordConfirmError = "";
// REGEX
// Définition de la variable de sécurité pour les Regex
$securityLevel = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $USER_LASTNAME = $_POST['USER_LASTNAME'];
    $USER_FIRSTNAME = $_POST['USER_FIRSTNAME'];
    $USER_MAIL = $_POST['USER_MAIL'];
    $USER_PHONE = $_POST['USER_PHONE'];
    $USER_PASSWORD = $_POST['USER_PASSWORD'];
    $hashedPassword = password_hash($USER_PASSWORD, PASSWORD_DEFAULT);
    $USER_PASSWORD_CONFIRM = $_POST['USER_PASSWORD_CONFIRM'];
    // Définition des regex
    $regexLastname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexFirstname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexMail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/';
    $regexPhone = '/^(06|07)\d{8}$/';
    // Fonction lastname (regex)
    if ($USER_LASTNAME === "") {
        $lastnameError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexLastname, $USER_LASTNAME)) {
        $lastnameError = "";
    } else {
        $lastnameError = "<p class='invalid'>Le nom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
    };
    // Fonction firstname (regex)
    if ($USER_FIRSTNAME === "") {
        $firstnameError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexFirstname, $USER_FIRSTNAME)) {
        $firstnameError = "";
    } else {
        $firstnameError = "<p class='invalid'>Le prénom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
    };
    // Fonction mail (regex)
    if ($USER_MAIL === "") {
        $mailError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexMail, $USER_MAIL)) {
        $mailError = "";
    } else {
        $mailError = "<p class='invalid'>L'adresse mail est invalide.</p>";
    };
    // Fonction phone (regex)
    if ($USER_PHONE === "") {
        $phoneError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexPhone, $USER_PHONE)) {
        $phoneError = "";
    } else {
        $phoneError = "<p class='invalid'>Le numéro de téléphone est invalide.</p>";
    };
    // Fonction password
    if ($USER_PASSWORD !== $USER_PASSWORD_CONFIRM) {
        $passwordError = "<p class='invalid'>Les mots de passe doivent être identiques.</p>";
    } else {
        // FORCE MOT DE PASSE
        // Vérification de la force du mot de passe (au moins "moyen")
        if (preg_match('/[a-z]/', $USER_PASSWORD)) {
            $securityLevel++;
        }
        if (preg_match('/[A-Z]/', $USER_PASSWORD)) {
            $securityLevel++;
        }
        if (preg_match('/[0-9]/', $USER_PASSWORD)) {
            $securityLevel++;
        }
        if (preg_match('/[@?!$]/', $USER_PASSWORD)) {
            $securityLevel++;
        }
        if (strlen($USER_PASSWORD) >= 8) {
            $securityLevel++;
        }
        if ($securityLevel == 0) {
            $passwordError = "<p class='invalid'>Ce champ est obligatoire.</p>";
        } else if ($securityLevel < 2) {
            $passwordError = "<p class='invalid'>Mot de passe trop dangereux.</p>";
        } else {
            $passwordError = "";
        }
        // Vérification qu'aucune erreur n'est présente
        if ($lastnameError !== "" || $firstnameError !== "" || $mailError !== "" || $phoneError !== "" || $passwordError !== "") {
            $errorform = "<p class='errorform'>Veuillez corriger les erreurs avant d'envoyer le formulaire.</p>";
        } else {
            // BASE DE DONNÉES
            try {
                $db = new Database();
                $pdo = $db->createInstancePDO();
                $sql = "SELECT COUNT(*) AS count FROM user WHERE USER_MAIL = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$USER_MAIL]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                // On vérifie si l'employé existe déjà
                if ($result['count'] > 0) {
                    echo "L'employé existe déjà. (controller-signup.php)";
                } else {
                    // On ajoute l'employé
                    $sql = "INSERT INTO user (USER_MAIL, USER_FIRSTNAME, USER_LASTNAME, USER_PHONE, USER_PASSWORD) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$USER_MAIL, $USER_FIRSTNAME, $USER_LASTNAME, $USER_PHONE, $hashedPassword]);
                    echo "<script>
                    window.onload = function() {
                        // On cache le formulaire
                        var form = document.querySelector('form');
                        form.style.display = 'none';
                        document.body.appendChild(welcomeMessage);
                        // On redirige l'utilisateur vers la page d'accueil
                        setTimeout(function() {
                            window.location.href = '../../Coiffadom/controllers/controller-login.php';
                        }, 3000);
                        // On affiche le décompte
                        var count = 3;
                        var countDown = document.createElement('p');
                        countDown.innerHTML = '<p class=\"redirectToLoginMessage\">Vous allez être redirigé vers la page Connexion dans ' + count + ' secondes.</p>';
                        document.body.appendChild(countDown);
                        // On redirige l'utilisateur vers la page de Connexion
                        var interval = setInterval(function() {
                            count--;
                            countDown.innerHTML = '<p class=\"redirectToLoginMessage\">Vous allez être redirigé vers la page Connexion dans ' + count + ' secondes.</p>';
                            if (count === 0) {
                                clearInterval(interval);
                            }
                        }, 1000);
                    };
                </script>";
                }
            } catch (PDOException $exception) {
                echo "Erreur lors de l'ajout de l'employé : " . $exception->getMessage() . "<br>";
            }
        }
    }
}
?>
<?php include "../views/signup.php"; ?>