<?php require_once "../config.php"; ?>
<?php require_once "../helpers/database.php"; ?>
<?php require_once "../models/user.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mail']) && isset($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $result = User::getInfosUser($mail);
        //On vérifie si l'utilisateur existe dans la base de données
        if ($mail == "") {
            $msgMail = "<p class='invalid'>Veuillez entrer une adresse e-mail.</p>";
        } else if ($result == false) {
            $msgMail = "<p class='invalid'>L'utilisateur n'existe pas.</p>";
        } else {
            $test = User::getInfosUser($password);
            //On vérifie si le mot de passe est correct
            if (password_verify($password, $result['password'])) {
                //On démarre la session
                session_start();
                //On enregistre le nom d'utilisateur dans la session
                $_SESSION['user'] = $result;
                unset($_SESSION['user']['password']);
                //On redirige vers la page d'accueil
                header('Location: ../controllers/controller-home.php');
                exit();
            } else if ($password == "") {
                $msgMdp = "<p class='invalid'>Veuillez entrer un mot de passe.</p>";
            } else if ($test == false) {
                $msgMdp = "<p class='invalid'>Le mot de passe est incorrect.</p>";
            }
        }
    }
}
?>
<?php include "../views/login.php"; ?>
