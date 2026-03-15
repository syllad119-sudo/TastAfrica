<?php
require_once __DIR__ . '/../../config/database.php';

$pdo = Database::getInstance();

// ✅ Jointure entre les 2 tables
$stmt = $pdo->query("
    SELECT 
        p.product_id,
        p.name,
        p.price,
        p.image,
        p.desc_,
        p.in_stock,
        c.name AS category_name
    FROM tasteafrica_product p
    JOIN taste_africa_category c ON p.category_id = c.category_id
");

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Taste Africa</title>
    <link rel="stylesheet" href="../../assets/css/burger.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="../../assets/css/style.css?v=<?= time() ?>" />
    <style>
        .show {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            border: 2px solid #2196F3;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2196F3;
            color: white;
        }

        tr:nth-child(even) {
            background-color: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>

<?php include '../../includes/header.php'; ?>

<div class="show">

    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 style="color:black;">Liste des produits par categorie</h1>
        <a href="dashboard.php">← Retour au dashboard</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Catégorie</th> <!-- ✅ Nom de la catégorie au lieu de l'ID -->
        </tr>

        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['product_id'] ?></td>

            <td>
                <?php
                    $imageName = basename($product['image']);
                    $imagePath = !empty($imageName)
                        ? '/TasteAfrica/assets/images/' . $imageName
                        : '/TasteAfrica/assets/images/default.png';
                ?>
                <img src="<?= htmlspecialchars($imagePath) ?>"
                     alt="<?= htmlspecialchars($product['name']) ?>"
                     width="80"
                     onerror="this.onerror=null; this.src='/TasteAfrica/assets/images/default.png';">
            </td>

            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['desc_']) ?></td>
            <td><?= number_format($product['price'], 2, ',', ' ') ?> €</td>
            <td><?= $product['in_stock'] ?></td>

            <!-- ✅ Affiche "Plats" au lieu de "1" -->
            <td><?= htmlspecialchars($product['category_name']) ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>

<?php include '../../includes/footer.php'; ?>

</body>
</html>