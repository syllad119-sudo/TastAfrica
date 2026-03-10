<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Remonter correctement vers le fichier database.php
include '../../config/database.php';

$pdo = Database::getInstance();

$stmt = $pdo->prepare("SELECT * FROM tasteafrica_product");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

 include '../../includes/header.php';

?>

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

<td>
<a href="edit.php?id=<?= $product['product_id'] ?>">Modifier</a>
<a href="delete.php?id=<?= $product['product_id'] ?>">Supprimer</a>
<a href="show.php?id=<?= $product['product_id'] ?>">Voir</a>

</td>
</tr>
<?php endforeach; ?>
</table>

<?php include '../../includes/footer.php'; ?>