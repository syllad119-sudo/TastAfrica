<?php
include 'includes/header.php';

$success = false;
$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $last_name  = trim($_POST['last_name'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $message    = trim($_POST['message'] ?? '');

    // Validations
    if (empty($last_name)) {
        $erreurs['last_name'] = 'Veuillez entrer votre nom';
    }
    if (empty($first_name)) {
        $erreurs['first_name'] = 'Veuillez entrer votre prénom';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Veuillez entrer un email valide';
    }
    if (empty($message)) {
        $erreurs['message'] = 'Veuillez entrer votre message';
    }

    // Si pas d'erreurs → INSERT en BDD
    if (empty($erreurs)) {
        require_once 'config/database.php';
        $pdo = Database::getInstance();

        // Génère un ID unique
        $id_contact = uniqid('contact_');

        $stmt = $pdo->prepare("INSERT INTO taste_africa_contact 
            (id_contact_, last_name, first_name, email, message_, date_time) 
            VALUES (:id_contact, :last_name, :first_name, :email, :message, :date_time)");

        $stmt->execute([
            'id_contact'  => $id_contact,
            'last_name'   => $last_name,
            'first_name'  => $first_name,
            'email'       => $email,
            'message'     => $message,
            'date_time'   => date('Y-m-d') // Date du jour
        ]);

        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire de contact</title>
    <link rel="stylesheet" href="assets/css/burger.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>" />
</head>
<body>

<main>
    <section class="contact-section">
        <div class="container">
            <h1>Contactez-nous</h1>
            <p class="subtitle">
                Remplissez le formulaire ci-dessous et nous vous répondrons rapidement.
            </p>

            <?php if ($success): ?>
                <div class="success-message show">
                    Votre message a été envoyé avec succès !
                </div>
            <?php endif; ?>

            <form action="contact.php" method="POST">

                <div class="form-group">
                    <label for="last_name">Nom *</label>
                    <input type="text" id="last_name" name="last_name"
                        value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>"
                        class="<?= isset($erreurs['last_name']) ? 'error' : '' ?>"
                        required />
                    <span class="error-message <?= isset($erreurs['last_name']) ? 'show' : '' ?>">
                        <?= $erreurs['last_name'] ?? '' ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="first_name">Prénom *</label>
                    <input type="text" id="first_name" name="first_name"
                        value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>"
                        class="<?= isset($erreurs['first_name']) ? 'error' : '' ?>"
                        required />
                    <span class="error-message <?= isset($erreurs['first_name']) ? 'show' : '' ?>">
                        <?= $erreurs['first_name'] ?? '' ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        class="<?= isset($erreurs['email']) ? 'error' : '' ?>"
                        required />
                    <span class="error-message <?= isset($erreurs['email']) ? 'show' : '' ?>">
                        <?= $erreurs['email'] ?? '' ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message"
                        class="<?= isset($erreurs['message']) ? 'error' : '' ?>"
                        required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    <span class="error-message <?= isset($erreurs['message']) ? 'show' : '' ?>">
                        <?= $erreurs['message'] ?? '' ?>
                    </span>
                </div>

                <button type="submit">Envoyer le message</button>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/burger.js"></script>
<script src="assets/js/index.js"></script>
</body>
</html>