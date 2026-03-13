<?php
session_start();
include '../../config/database.php';

// inclure le fichier une seule fois dans le script erreur fatale le script s'arrete si le n'existe pas 
// ^ header.php demarre aussi la session// Crée un tableau vide pour stocker les messages d’erreurs.
$erreurs = [];
// Variable booléenne qui servira à indiquer si tout s’est bien passé (inscription réussie par exemple).
$succes = false;
// On vérifie si le formulaire a été envoyé en POST.
//  Cela permet d’exécuter le traitement uniquement quand le formulaire est soumis.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mdp'] ?? '';
    $mdpConfirm = $_POST['mdp_confirm'] ?? '';

    // Prepare les variables pour faire les validations
    // if (empty($prenom) || strlen($prenom) < 2) {
    //     $erreurs[] = "Le prénom doit contenir au moins 2 caractères.";
    // }
    if (empty($nom) || strlen($nom) < 4) {
        $erreurs[] = "Le nom doit contenir au moins 4 caractères.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email n'est pas valide.";
    }
    if (strlen($mdp) < 8) {
        $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }
    if ($mdp !== $mdpConfirm) {
        $erreurs[] = "Les mots de passe ne correspondent pas.";
    }

    // Vérifier qu'il ya aucune erreur precedente s'il yen as continue pas 
    if (empty($erreurs)) {
        // protection contre injection SQL 
        // On prepare et on execute email par sa Valeur en affichant un msg d'erreur s'il ya une erreur 
        $stmt = Database::getInstance()->prepare("SELECT user_id FROM taste_africa_user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $erreurs[] = "Cet email est déjà utilisé.";
        }
    }
    // On continue toujours s'il nya aucune Erreur 
    if (empty($erreurs)) {
        // On ne stocke jamais le mots de passe en claire dans la BDD d'ou Le hash 
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
        //  On prépare une requête d’insertion avec des paramètres nommés.
        $stmt = Database::getInstance()->prepare(
            "INSERT INTO taste_africa_user ( name, email, password) VALUES ( :name, :email, :password)"
        );
        $stmt->execute([
            // 'prenom' => $prenom,
            'name' => $nom,
            'email' => $email,
            'password' => $mdpHash
        ]);
        // Si tout s'est bien passé L'utilisateur est enregistrer 
        $succes = true;
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="150 words" />

    <title> Inscription </title>
    <style>
        form {
            max-width: 400px;
            margin: 20px auto;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
        }

        .erreur {
            color: red;
        }

        .succes {
            color: green;
        }
    </style>
    <link rel="stylesheet" href="../../assets/css/burger.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="../../assets/css/style.css?v=<?= time() ?>" />

</head>

<body>

    <?php include '../../includes/header.php'; ?>
    <main>
        <!-- On affiche les messages d'erreurs ou de succes avec dans la page  -->
        <form action="" method="POST">
            <h1>Inscription </h1>

            <?php if ($succes): ?>
                <p class="succes">Compte créé avec succès !
                    <a href="login.php">Se connecter</a>
                </p>
            <?php else: ?>
                <!-- Le tableau n'est pas vide verifie si'il ya une erreur et affiche moi quelque chose  -->
                <?php if (!empty($erreurs)): ?>
                    <ul class="erreur">
                        <?php foreach ($erreurs as $erreur): ?>
                            <li><?= $erreur ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <!-- <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom"
                   value="<?= htmlspecialchars($prenom ?? '') ?>" required> -->

                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom"
                    value="<?= htmlspecialchars($nom ?? '') ?>" required>

                <label for="email">Email :</label>
                <input type="email" name="email" id="email"
                    value="<?= htmlspecialchars($email ?? '') ?>" required>

                <label for="mdp">Mot de passe :</label>
                <input type="password" name="mdp" id="mdp" required minlength="8">

                <label for="mdp_confirm">Confirmer :</label>
                <input type="password" name="mdp_confirm" id="mdp_confirm" required>

                <button type="submit">Créer mon compte</button>
                <!-- <p><a href="exo16-connexion.php">Déjà inscrit ? Se connecter</a></p> -->

            <?php endif; ?>
            <!-- ✔ Utilisation de PDO
✔ Requêtes préparées (sécurité SQL)
✔ Mot de passe hashé
✔ Vérification email existant -->
        </form>
        <p><a href="login.php">Déjà inscrit ? Se connecter</a></p>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>