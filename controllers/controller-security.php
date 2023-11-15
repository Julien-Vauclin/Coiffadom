<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<!-- FONCTIONS -->
<!-- Variables -->
<?php
$USER_FIRSTNAME = $USER_LASTNAME = $USER_PHONE = "";
$USER_FIRSTNAME_ERROR = $USER_LASTNAME_ERROR = $USER_PHONE_ERROR = $USER_FORM_ERROR = "";
$errorValue = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $USER_MAIL = $_SESSION['user']['USER_MAIL'];
    $ID = $_SESSION['user']['ID'];
    $USER_FIRSTNAME = $_POST['USER_FIRSTNAME'];
    $USER_LASTNAME = $_POST['USER_LASTNAME'];
    $USER_PHONE = $_POST['USER_PHONE'];
    // Définition des regex
    $regexFirstname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexLastname = '/^[a-zA-Z-éèëêàäâûüúîïìôöòÿýÉÈËÊÀÄÂÛÜÚÎÏÌÔÖÒ-]+$/';
    $regexPhone = '/^(06|07)\d{8}$/';
    // Fonction firstname (regex)
    if ($USER_FIRSTNAME === "") {
        $USER_FIRSTNAME_ERROR = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $errorValue++;
    } elseif (preg_match($regexFirstname, $USER_FIRSTNAME)) {
        $USER_FIRSTNAME_ERROR = "";
    } else {
        $USER_FIRSTNAME_ERROR = "<p class='invalid'>Le prénom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
        $errorValue++;
    };
    // Fonction lastname (regex)
    if ($USER_LASTNAME === "") {
        $USER_LASTNAME_ERROR = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $errorValue++;
    } elseif (preg_match($regexLastname, $USER_LASTNAME)) {
        $USER_LASTNAME_ERROR = "";
    } else {
        $USER_LASTNAME_ERROR = "<p class='invalid'>Le nom est invalide. (Caractères spéciaux interdits, sauf \"-\")</p>";
        $errorValue++;
    };
    // Fonction phone (regex)
    if ($USER_PHONE === "") {
        $USER_PHONE_ERROR = "<p class='invalid'>Ce champ est obligatoire.</p>";
        $errorValue++;
    } elseif (preg_match($regexPhone, $USER_PHONE)) {
        $USER_PHONE_ERROR = "";
    } else {
        $USER_PHONE_ERROR = "<p class='invalid'>Le numéro de téléphone est invalide.</p>";
        $errorValue++;
    };
    // On vérifie que le prénom, le nom ou le téléphone ne sont pas les mêmes que dans la base de données
    $infosUser = User::getInfosUser($USER_MAIL);
    if ($USER_FIRSTNAME == $infosUser['USER_FIRSTNAME'] && $USER_LASTNAME == $infosUser['USER_LASTNAME'] && $USER_PHONE == $infosUser['USER_PHONE']) {
        $errorValue++;
        $USER_FORM_ERROR = "<p class='invalid'>Vous n'avez modifié aucune information.</p>";
    }
    // Si aucune erreur n'est détectée, on envoie les données dans la base de données
    if ($errorValue == 0) {
        $result = User::updateInfosUser($USER_FIRSTNAME, $USER_LASTNAME, $USER_PHONE, $ID);
        $_SESSION['user'] = User::getInfosUser($USER_MAIL);
        if ($result) {
            header("Location: ../controllers/controller-security.php");
            exit;
        } else {
            $errorform = "<p class='invalid'>Erreur lors de la modification des informations.</p>";
        }
    }
}
?>
<?php include "../views/security.php"; ?>