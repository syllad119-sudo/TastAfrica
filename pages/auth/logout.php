<?php
//  Identifier une session avant de le detruire 
session_start();
// On vide le panier de l'utilisateur 
// la Session existe encore mais elle es totalement vide 
$_SESSION = [];
// Detruire le cookie de la session pour eviter le vols de cookies 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// Destruction de la session et redirection vers la base de connexion 
//Exit permet enfin d'arreter l'excution du script 
session_destroy();
header("Location: login.php");
exit;
?>