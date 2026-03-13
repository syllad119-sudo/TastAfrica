<?php

require_once __DIR__ . '/../../config/database.php';
$pdo = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = $_POST['name'];
  $price = $_POST['price'];
  $desc = $_POST['desc'];
  $in_stock = $_POST['in_stock'];
  $category_id = $_POST['category_id'];
  $imageName = 'default.png'; // valeur par défaut

  // Vérifie si un fichier a été uploadé
  if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $uploadDir = __DIR__ . '/../../images/';
    $imageName = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $imageName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
      die('Erreur lors du téléchargement de l\'image.');
    }
  }

  // ✅ $imagePath défini ici, DANS le if POST
  $imagePath = '/images/' . $imageName;

  $stmt = $pdo->prepare("INSERT INTO tasteafrica_product (image, name, category_id, created_At, price, in_stock, `desc_`) 
    VALUES (:image, :name, :category_id, NOW(), :price, :in_stock, :desc_)");

  $stmt->execute([
    'image'       => $imagePath,
    'name'        => $name,
    'category_id' => $category_id,
    'price'       => $price,
    'in_stock'    => $in_stock,
    'desc_'       => $desc
  ]);

  echo "Produit ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un produit</title>
</head>
<body>

  <h1>Ajouter un article</h1>

  <form action="add_product.php" method="POST" enctype="multipart/form-data">

    <label>Image :</label>
    <input type="file" name="image">

    <label>Nom :</label>
    <input type="text" name="name" required>

    <label>Description :</label>
    <textarea name="desc" required></textarea>

    <label>Prix :</label>
    <input type="number" step="0.01" name="price" required>

    <label>En stock :</label>
    <input type="number" name="in_stock" value="1" required>

    <label>Catégorie :</label>
    <select name="category_id">
      <option value="1">Plats</option>
      <option value="2">Boissons</option>
      <option value="3">Desserts</option>
    </select>

    <button type="submit">Ajouter</button>
  </form>

</body>
</html>