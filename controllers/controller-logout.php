<p>PAGE LOGOUT</p>
<?php
// On démarre la session, ce qui permet de récupérer les variables de session et d'empêcher l'accès à la page aux utilisateurs non connectés
session_start();
// On détruit la session (déconnexion)
session_destroy();
// On redirige l'utilisateur vers la page d'accueil
header("Location: ../../Coiffadom/controllers/controller-home.php");
exit();
?>