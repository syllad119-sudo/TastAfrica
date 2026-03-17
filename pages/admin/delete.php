<?php
require_once __DIR__ . '/../../config/database.php';

$pdo = Database::getInstance();

// Si on pas reçoit un ID à supprimer
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // (int) pour sécuriser contre les injections SQL

    $stmt = $pdo->prepare("DELETE FROM tasteafrica_product WHERE product_id = :id");
    $stmt->execute(['id' => $id]);

    header('Location: delete.php'); // Recharge la page après suppression
    exit;
}

// Récupère tous les produits
$stmt = $pdo->query("SELECT * FROM tasteafrica_product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un produit - Taste Africa</title>
</head>
<body>
<main>


    <h1>Supprimer un produit</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>En stock</th>
            <th>Catégorie</th>
            <th>Action</th>
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
                     width="100"
                     onerror="this.onerror=null; this.src='/TasteAfrica/assets/images/default.png';">
            </td>

            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= $product['price'] ?> €</td>
            <td><?= $product['in_stock'] ?></td>
            <td><?= $product['category_id'] ?></td>

            <td>
                <!-- Demande confirmation avant de supprimer -->
                <a 
                    href="delete.php?id=<?= $product['product_id'] ?>"
                    onclick="return confirm('Supprimer <?= htmlspecialchars($product['name']) ?> ?')"
                    style="color: red;"
                >
                    🗑️ Supprimer
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <br>
    <a href="show.php">← Retour à la liste</a>
    </main>

</body>
</html>