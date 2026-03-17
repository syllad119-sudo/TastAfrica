<?php
// Demarrer une session 
session_start();
include '../../config/database.php';
//  Si l'utilisateur est deja connecté on le  redirige vers le dashboard 
// Ici, on empêche un utilisateur déjà connecté d’accéder au formulaire de login.

if (isset($_SESSION['user_id'])) {
header("Location: ../admin/dashboard.php");
    exit;
}

//  if ($_SESSION['user_role'] !== 'admin') {
//     header("Location: /TasteAfrica/index.php"); // ← redirige vers l'accueil
//     exit;
// }


// On crée une variable vide pour stocker un éventuel message d’erreur (ex : “Email incorrect”).
$erreur = '';
//  Verifier si le formulaire à éte envoyer ou soumis 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //  Recuperation et securisation des donnees email et most de passe 
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mdp'] ?? '';
    //  Preparations securisee  de la requète SQL 
    // Si un utilisateur existe avec cet email → $user contient ses données.
    $stmt =  Database::getInstance()->prepare("SELECT * FROM  taste_africa_user WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    // $user → vérifie que l’utilisateur existe dans la base.
    // password_verify($mdp, $user['password']) → compare le mot de passe saisi ($mdp) 
    // avec le mot de passe hashé stocké dans la base.
    if ($user && password_verify($mdp, $user['password'])) {
        //Creation d'une sessions securisées 
        // change l'id de sessions pour eviter le vol de sessions
        // $_SESSION stocke les infos de l’utilisateur pour toute la durée de la session :
        if ($user && password_verify($mdp, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['id']        = $user['id'] ?? null;
            $_SESSION['user_role'] = $user['role'] ?? '';
            $_SESSION['name']      = $user['nom'] ?? '';   // ✅ Ajout du ?? ''

            header("Location: ../admin/dashboard.php");
            exit;
        } 
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="150 words" />

    <title> Connexion</title>

    <style>
        form { max-width: 500px; margin: 80px auto; padding: 30px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 15px; padding: 10px 20px; }
        .erreur { color: red; }
    </style>
    <link rel="stylesheet" href="../../assets/css/burger.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="../../assets/css/style.css?v=<?= time() ?>" />

</head>

<body>
    <?php include '../../includes/header.php'; ?>



    <form action="" method="POST">
        <h1>Connexion Taste africa</h1>
        <!-- Permet de verifier si Erreur nest pas vide et d'affiche le msg comme mdp incorect  -->
        <!-- Sil ya une erreur a montre affiche la  -->
        <?php if (!empty($erreur)): ?>
            <p class="erreur"><?= $erreur ?></p>
        <?php endif; ?>

        <label for="email" style="color: black;">Email :</label>
        <input type="email" name="email" id="email"
            value="<?= htmlspecialchars($email ?? '') ?>" required>


        <label for="mdp" style="color: black;"> Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" required minlength="8">

        <button type="submit">Se connecter</button>
        <p><a href="register.php">Pas encore de compte ? S'inscrire</a></p>
    </form>
    <!-- L’utilisateur soumet email + mot de passe.
Le script cherche l’utilisateur dans la base.
Si trouvé → vérification du mot de passe avec password_verify.
Si correct → création de la session + redirection vers le dashboard.
Sinon → affichage d’une erreur “Email ou mot de passe incorrect.” -->
    <?php include '../../includes/footer.php'; ?>

</body>
</html>