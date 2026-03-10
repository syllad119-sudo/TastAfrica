<?php

require_once __DIR__ . '/../config/Database.php';

$pdo = Database::getInstance();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$in_stock = $_POST['in_stock'];
$category_id = $_POST['category_id'];

$stmt = $pdo->prepare("
INSERT INTO `tasteafrica_product`
(`name`, `desc_`, `price`, `in_stock`, `created_at`, `category_id`)
VALUES ('Dibi viande', '15', 'Dibi viande accompagné d’une portion de riz rouge et de riz blanc mélangé, alokos, frites, plus sauce mafé ou yassa', 15,'1),
('jus de gingembre', 'Jus de Bissap', 4.00, 1, '2026-03-05', 2), 'Riz avec sauce d''arachide et viande', 'Thiebou Dienne', 14.99, 1, '2026-03-06', 1),
('Couscous sénégalais aux légumes et poulet', 'Couscous de Casamance', 13.50, 1, '2026-03-06', 1),
('Acras de morue croustillants', 'Accras de Morue', 8.50, 1, '2026-03-06', 1),
('Ragout de viande lente', 'Mafé Traditionnel', 15.00, 1, '2026-03-07', 1),
('Pâte de maïs avec sauce', 'Fufu Camerounais', 11.99, 1, '2026-03-07', 1),
('Jus naturel de fruits frais', 'Jus de Mangue Fraîche', 3.50, 1, '2026-03-06', 2),
('Boisson à base de mil fermenté', 'Bissap Traditionnel', 4.00, 1, '2026-03-06', 2),
('Café africain fort et riche', 'Café Éthiopien', 3.99, 1, '2026-03-07', 2),
('Thé aux épices et miel', 'Thé Marocain à la Menthe', 2.99, 1, '2026-03-07', 2),
('Jus de canne à sucre frais', 'Jus de Canne', 3.00, 1, '2026-03-08', 2),
"); 

$stmt->execute([$name,$desc,$price,$in_stock,$category_id]);

echo "Plat ajouté";

}

?>

<h1>Ajouter un plat</h1>

<form action="add_product.php" method="POST">
  <label>Nom :</label>
  <input type="text" name="name" required>

  <label>Description :</label>
  <textarea name="desc_" required></textarea>

  <label>Prix :</label>
  <input type="number" step="0.01" name="price" required>

  <label>En stock :</label>
  <input type="number" name="in_stock" value="1" required>

  <label>Catégorie :</label>
  <select name="category_id">
    <option value="1">Entrée</option>
    <option value="2">Plat principal</option>
    <option value="3">Dessert</option>
  </select>

  <button type="submit">Ajouter</button>
</form>