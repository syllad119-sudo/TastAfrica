<?php
require_once __DIR__ . '/../../config/database.php';

$pdo = Database::getInstance();
// On fais une requete pour recuperer tout les plats 
$stmt = $pdo->query("SELECT * FROM tasteafrica_product");

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Produits - Taste Africa</title>

    <style>
        .show {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #2196F3;
            border-radius: 8px;
        }
    </style>
    <link rel="stylesheet" href="../../assets/css/burger.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="../../assets/css/style.css?v=<?= time() ?>" />


</head>

<body>
<?php include '../../includes/header.php'; ?>

<!-- <main> -->

<div class="show">

<h1 style="color: blue;">Liste des produits</h1>
<a href="dashboard.php">←Retour à la Gestion de stock</a>

    
<table border="1">

        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>in_stock</th>
            <th>category_id</th>

        </tr>

        <!-- Faire la boucle pour afficher les produits -->

        <?php foreach ($products as $product): ?>

            <tr>

                <td><?= $product["product_id"] ?></td>

                <td>
                    <img src="<?= basename ($product['image'])?>" width="100">
                </td>

                <td><?= $product['name'] ?></td>

                <td><?= $product['price'] ?> €</td>

                <td><?= $product['in_stock'] ?> </td>

                <td><?= $product['category_id'] ?> </td>

            </tr>

        <?php endforeach; ?>

        </table>
        </div>
        <!-- </main> -->
            <?php include '../../includes/footer.php'; ?>
</body>
</html>