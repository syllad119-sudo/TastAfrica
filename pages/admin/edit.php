<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/database.php';

$pdo = Database::getInstance();

// Si pas d'ID dans l'URL, on retourne à la liste
if (!isset($_GET['id'])) {
    header('Location: show.php');
    exit;
}

$id = (int) $_GET['id'];

// =====================
// Traitement du formulaire
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = $_POST['name'];
    $price       = $_POST['price'];
    $desc        = $_POST['desc'];
    $in_stock    = $_POST['in_stock'];
    $category_id = $_POST['category_id'];

    // Récupère l'ancienne image par défaut
    $stmt = $pdo->prepare("SELECT image FROM tasteafrica_product WHERE product_id = :id");
    $stmt->execute(['id' => $id]);
    $ancien    = $stmt->fetch(PDO::FETCH_ASSOC);
    $imageName = basename($ancien['image']);

    // Si une nouvelle image est uploadée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = __DIR__ . '/../../assets/images/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageName  = basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            die('Erreur lors du téléchargement de l\'image.');
        }
    }

    $imagePath = '/assets/images/' . $imageName;

    $stmt = $pdo->prepare("UPDATE tasteafrica_product SET 
        image       = :image,
        name        = :name,
        price       = :price,
        desc_       = :desc_,
        in_stock    = :in_stock,
        category_id = :category_id
        WHERE product_id = :id
    ");

    $stmt->execute([
        'image'       => $imagePath,
        'name'        => $name,
        'price'       => $price,
        'desc_'       => $desc,
        'in_stock'    => $in_stock,
        'category_id' => $category_id,
        'id'          => $id
    ]);

    header('Location: show.php');
    exit;
}

// =====================
// Affichage du formulaire
// =====================
$stmt = $pdo->prepare("SELECT * FROM tasteafrica_product WHERE product_id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die('Produit introuvable.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit - Taste Africa</title>
     <style>
        .edit {
            max-width: 450px;
            margin: 15px auto;
            padding: 5px;
            border: 2px solid #2196F3;
            border-radius: 8px;
        }
    </style> 

    <link rel="stylesheet" href="../../assets/css/burger.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="../../assets/css/style.css?v=<?= time() ?>" />

</head>
<body>
        <?php include '../../includes/header.php'; ?>
        
        <div class="edit">


<!-- <main> -->

    <h1 style="color: blue;" >Modifier : <?= htmlspecialchars($product['name']) ?></h1>

<form class="form-edit" action="edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

        <label>Image actuelle :</label><br>
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
        <br>

        <label>Nouvelle image (laisser vide pour garder l'actuelle) :</label><br>
        <input type="file" name="image">
        <br>

        <label>Nom :</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        <br>

        <label>Description :</label><br>
        <textarea name="desc" required><?= htmlspecialchars($product['desc_']) ?></textarea>
        <br>

        <label>Prix :</label><br>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>
        <br>

        <label>En stock :</label><br>
        <input type="number" name="in_stock" value="<?= $product['in_stock'] ?>" required>
        <br>

        <label>Catégorie :</label><br>
        <select name="category_id">
            <option value="1" <?= $product['category_id'] == 1 ? 'selected' : '' ?>>Plats</option>
            <option value="2" <?= $product['category_id'] == 2 ? 'selected' : '' ?>>Boissons</option>
            <option value="3" <?= $product['category_id'] == 3 ? 'selected' : '' ?>>Desserts</option>
        </select>
        <br><br>

        <button type="submit">✅ Enregistrer les modifications</button>
        <a href="show.php">← Annuler</a>

    </form>
    </div>
    <!-- </main> -->
    <?php include '../../includes/footer.php'; ?>

</body>
</html>