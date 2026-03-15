<?php 
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menu</title>
  <link rel="stylesheet" href="assets/css/burger.css?v=<?= time() ?>" />
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>" />
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <h1>La Carte</h1>

  <select id="categorySelect">
    <option value="all">Toutes les catégories</option>
    <option value="1">Plats</option>
    <option value="2">Boissons</option>
    <option value="3">Desserts</option>
  </select>

  <div id="products-container">
    <?php 
      $pdo = Database::getInstance();
      $stmt = $pdo->query("SELECT * FROM tasteafrica_product");
      $rows = $stmt->fetchAll();

      foreach ($rows as $row) : 
        // Si l'image est vide ou corrompue, on met une image par défaut
        // $image = !empty($row['image']) ? 'images/default.png':$row['image'];
          $image = (!empty($row['image'])) ? $row['image'] : 'images/default.png';

        
    ?>

    <article class="product-card" data-category="<?= $row['category_id'] ?>">
      <img 
        src="<?= htmlspecialchars($image) ?>" 
        alt="<?= htmlspecialchars($row['name']) ?>" 
        style="width:400px;"
        onerror="this.src='assets/images/default.png';"
      >
      <h2><?= htmlspecialchars($row['name']) ?></h2>
      <p><?= htmlspecialchars($row['desc_']) ?></p>
      <p>Prix : <?= number_format($row['price'], 2, ',', ' ') ?> €</p>
      <?php if ($row['in_stock'] > 0) : ?>
        <span style="color:green;">En stock</span>
      <?php else : ?>
        <span style="color:red;">Rupture de stock</span>
      <?php endif; ?>
    </article>

    <?php endforeach; ?>
  </div>

</main>

<?php include 'includes/footer.php'; ?>

<script src="js/index.js"></script>
<script src="js/burger.js"></script>
</body>
</html>