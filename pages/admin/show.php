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
</head>

<body>
<main>

    <h1>Liste des produits</h1>

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
        </main>

</body>
</html>