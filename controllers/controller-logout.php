<p>PAGE LOGOUT</p>
<?php
// On démarre la session
session_start();
// On détruit la session (déconnexion)
session_destroy();
// On redirige l'utilisateur vers la page d'accueil
header("Location: ../../Coiffadom/controllers/controller-home.php");
exit();
?>