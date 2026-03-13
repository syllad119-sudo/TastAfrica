<?php
session_start();
include 'includes/header.php';
include 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/burger.css?v=<?= time() ?>" />
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>" />
</head>

<body>

<main>
  <section class="back">
    <div class="back__content">
      <h1>Bienvenue à Taste Africa</h1>
      <p>
        Découvrez les saveurs authentiques <br />
        d'Afrique dans chaque plat que <br />
        nous préparons avec passion.
      </p>
    </div>
  </section>
  <section>

  </section>
  <section class="card">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2901.6149159682805!2d5.394973675994751!3d43.34324657111848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9bff6945fdd13%3A0x97493f5acd920579!2s54%20Rue%20Gabriel%20Audisio%2C%2013014%20Marseille!5e0!3m2!1sfr!2sfr!4v1766966184028!5m2!1sfr!2sfr"
      title="adresse de mon restaurant"
      style="border: 0"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>
</main>

<?php
include 'includes/footer.php';
?>

</body>

</html>
