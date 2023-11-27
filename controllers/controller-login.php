<!-- Require -->
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>

<!-- Fonctions -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['USER_MAIL']) && isset($_POST['USER_PASSWORD'])) {
        $USER_MAIL = $_POST['USER_MAIL'];
        $USER_PASSWORD = $_POST['USER_PASSWORD'];
        $result = User::getInfosUser($USER_MAIL);
        //On vérifie si l'utilisateur existe dans la base de données
        if ($USER_MAIL == "") {
            $msgMail = "<p class='invalid'>Veuillez entrer une adresse e-mail.</p>";
        } else if ($result == false) {
            $msgMail = "<p class='invalid'>L'utilisateur n'existe pas.</p>";
        } else {
            $test = User::getInfosUser($USER_PASSWORD);
            //On vérifie si le mot de passe est correct
            if (password_verify($USER_PASSWORD, $result['USER_PASSWORD'])) {
                //On démarre la session
                session_start();
                //On enregistre le nom d'utilisateur dans la session
                $_SESSION['user'] = $result;
                unset($_SESSION['user']['USER_PASSWORD']);
                // Stockez également le nom et le prénom dans la session
                $_SESSION['user']['USER_FIRSTNAME'] = $result['USER_FIRSTNAME'];
                $_SESSION['user']['USER_LASTNAME'] = $result['USER_LASTNAME'];
                //On redirige vers la page d'accueil
                header('Location:../controllers/controller-home.php');
                exit();
            } else if ($USER_PASSWORD == "") {
                $msgMdp = "<p class='invalid'>Veuillez entrer un mot de passe.</p>";
            } else if ($test == false) {
                $msgMdp = "<p class='invalid'>Le mot de passe est incorrect.</p>";
            } else {
                $msghaha = "Bienvenue " . $result['USER_FIRSTNAME'] . " " . $result['USER_LASTNAME'] . " !";
            }
        }
    }
}
?>

<!-- Include -->
<?php include "../views/login.php"; ?>