<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Remonter correctement vers le fichier database.php
include '../../config/database.php';

// Verifier si l'itulisateur n'est pas connecter 

// if (!isset($_SESSION['user_id'])) {
//     // Si ce n’est pas le cas, on le redirige vers la page de connexion.
//     header("Location: login.php");
//     exit;
// }
$pdo = Database::getInstance();

$stmt = $pdo->prepare("SELECT * FROM tasteafrica_product");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="150 words" />

    <title> Gestion des stocks </title>
    <style>
        .dashboard { max-width: 500px; margin: 50px auto; padding: 20px;
                     border: 2px solid #2196F3; border-radius: 8px; }
    </style>
    <link rel="stylesheet" href="../../assets/css/burger.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />

</head>

<body>

    <?php include '../../includes/header.php'; ?>

<div class="dashboard">
<h1>Dashboard Admin</h1>

<a href="add_product.php">Ajouter un plat</a>

<table border="1">
<tr>
<th>Nom</th>
<th>Prix</th>
<th>Catégorie</th>
<th>stock</th>
</tr>

<?php foreach($products as $product): ?>
<tr>
<td><?= htmlspecialchars($product['name']) ?></td>
<td><?= htmlspecialchars($product['price']) ?> €</td>
<td><?= htmlspecialchars($product['category'] ?? '') ?></td>
<td><?= htmlspecialchars($product['in_stock'] ?? '') ?></td>
<a href="../auth/logout.php">Se déconnecter</a>  <!-- ✅ -->



<td>
<a href="edit.php?id=<?= $product['product_id'] ?>">Modifier</a>
<a href="delete.php?id=<?= $product['product_id'] ?>">Supprimer</a>
<a href="show.php?id=<?= $product['product_id'] ?>">Voir</a>


</td>
</tr>
<?php endforeach; ?>
</table>
</div>

<?php include '../../includes/footer.php'; ?>
</body>

</html>