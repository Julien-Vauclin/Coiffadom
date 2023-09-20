<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php $errorform = ""; ?>
<?php
// VARIABLES
// Variables pour stocker les valeurs des champs du formulaire
$lastname = $firstname = $mail = $phone = $password = $passwordConfirm = "";
// Variables pour stocker les messages d'erreur
$lastnameError = $firstnameError = $mailError = $phoneError = $passwordError = $passwordConfirmError = "";
// REGEX
// Définition de la variable de sécurité pour les Regex
$securityLevel = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $passwordConfirm = $_POST['passwordConfirm'];
    // Définition des regex
    $regexLastname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexFirstname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexMail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/';
    $regexPhone = '/^(06|07)\d{8}$/';
    // Fonction lastname (regex)
    if ($lastname === "") {
        $lastnameError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexLastname, $lastname)) {
        $lastnameError = "";
    } else {
        $lastnameError = "<p class='invalid'>Le nom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
    };
    // Fonction firstname (regex)
    if ($firstname === "") {
        $firstnameError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexFirstname, $firstname)) {
        $firstnameError = "";
    } else {
        $firstnameError = "<p class='invalid'>Le prénom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
    };
    // Fonction mail (regex)
    if ($mail === "") {
        $mailError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexMail, $mail)) {
        $mailError = "";
    } else {
        $mailError = "<p class='invalid'>L'adresse mail est invalide.</p>";
    };
    // Fonction phone (regex)
    if ($phone === "") {
        $phoneError = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } elseif (preg_match($regexPhone, $phone)) {
        $phoneError = "";
    } else {
        $phoneError = "<p class='invalid'>Le numéro de téléphone est invalide.</p>";
    };
    // Fonction password
    if ($password !== $passwordConfirm) {
        $passwordError = "<p class='invalid'>Les mots de passe doivent être identiques.</p>";
    } else {
        // FORCE MOT DE PASSE
        // Vérification de la force du mot de passe (au moins "moyen")
        if (preg_match('/[a-z]/', $password)) {
            $securityLevel++;
        }
        if (preg_match('/[A-Z]/', $password)) {
            $securityLevel++;
        }
        if (preg_match('/[0-9]/', $password)) {
            $securityLevel++;
        }
        if (preg_match('/[@?!$]/', $password)) {
            $securityLevel++;
        }
        if (strlen($password) >= 8) {
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
                $sql = "SELECT COUNT(*) AS count FROM user WHERE mail = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$mail]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                // On vérifie si l'employé existe déjà
                if ($result['count'] > 0) {
                    echo "L'employé existe déjà. (inscription.php)";
                } else {
                    // On ajoute l'employé
                    $sql = "INSERT INTO user (lastname, firstname, mail, phone, password) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$lastname, $firstname, $mail, $phone, $hashedPassword]);
                    echo "L'employé a bien été ajouté. (inscription.php)";
                }
            } catch (PDOException $exception) {
                echo "Erreur lors de l'ajout de l'employé : " . $exception->getMessage() . "<br>";
            }
        }
    }
}
?>
<?php include "../views/signup.php"; ?>