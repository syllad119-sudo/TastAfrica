<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../config/database.php';

$pdo = Database::getInstance();

$stmt = $pdo->prepare("SELECT * FROM tasteafrica_product");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des stocks</title>

    <style>
        .dashboard {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #2196F3;
            border-radius: 8px;
        }
    </style>
    <link rel="stylesheet" href="../../assets/css/burger.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
</head>
<body>

<?php include '../../includes/header.php'; ?>

<div class="dashboard">

<h1 id="titre-dashboard">Gestion des stocks</h1>
    <!-- ✅ Déconnexion en haut, une seule fois -->
    <div style="text-align:right; margin-bottom:10px;">
        <a href="../auth/logout.php">Se déconnecter</a>
    </div>

    <a href="add_product.php">➕ Ajouter un plat</a>

    <a href="show_with_category.php">📋 Voir produits avec catégories</a>
```

    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Stock</th>
            <th>Actions</th> <!-- ✅ Colonne ajoutée -->
        </tr>

        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['price']) ?> €</td>
            <td><?= htmlspecialchars($product['category_id'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['in_stock'] ?? '') ?></td>

            <!-- ✅ Une seule <td> pour les actions -->
            <td>
                <a href="edit.php?id=<?= $product['product_id'] ?>">✏️ Modifier</a>
                <a href="delete.php?id=<?= $product['product_id'] ?>" 
                   onclick="return confirm('Supprimer <?= htmlspecialchars($product['name']) ?> ?')"
                   style="color:red;">
                   🗑️ Supprimer
                </a>
                <a href="show.php?id=<?= $product['product_id'] ?>">👁️ Voir</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>

<?php include '../../includes/footer.php'; ?>

</body>
</html>
Les corrections :
1 — Se déconnecter sorti de la boucle et placé en haut à droite du dashboard.
2 — Colonne <th>Actions</th> ajoutée pour que le tableau soit bien aligné.
3 — Confirmation avant suppression avec onclick="return confirm(...)".