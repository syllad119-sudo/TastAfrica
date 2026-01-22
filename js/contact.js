const form = document.getElementById("contactForm");
const successMessage = document.getElementById("successMessage");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  let isValid = true;

  // Réinitialiser les erreurs
  document
    .querySelectorAll(".error")
    .forEach((el) => el.classList.remove("error"));
  document
    .querySelectorAll(".error-message")
    .forEach((el) => el.classList.remove("show"));

  // Validation du nom
  const nom = document.getElementById("nom");
  if (nom.value.trim() === "") {
    nom.classList.add("error");
    document.getElementById("nomError").classList.add("show");
    isValid = false;
  }

  // Validation du prénom
  const prenom = document.getElementById("prenom");
  if (prenom.value.trim() === "") {
    prenom.classList.add("error");
    document.getElementById("prenomError").classList.add("show");
    isValid = false;
  }

  // Validation de l'email
  const email = document.getElementById("email");
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email.value)) {
    email.classList.add("error");
    document.getElementById("emailError").classList.add("show");
    isValid = false;
  }

  // Validation du téléphone
  const telephone = document.getElementById("telephone");
  const telRegex = /^[0-9\s\+\-\(\)]{10,}$/;
  if (!telRegex.test(telephone.value)) {
    telephone.classList.add("error");
    document.getElementById("telephoneError").classList.add("show");
    isValid = false;
  }

  // Validation du message
  const message = document.getElementById("message");
  if (message.value.trim() === "") {
    message.classList.add("error");
    document.getElementById("messageError").classList.add("show");
    isValid = false;
  }

  // Si tout est valide
  if (isValid) {
    // Afficher le message de succès
    successMessage.classList.add("show");

    // Réinitialiser le formulaire
    form.reset();

    // Masquer le message après 5 secondes
    setTimeout(() => {
      successMessage.classList.remove("show");
    }, 5000);

    // Ici vous pouvez ajouter le code pour envoyer les données à un serveur
    console.log("Formulaire soumis avec succès!");
  }
});

// Retirer l'erreur lors de la saisie
document.querySelectorAll("input, textarea").forEach((input) => {
  input.addEventListener("input", function () {
    this.classList.remove("error");
    const errorId = this.id + "Error";
    document.getElementById(errorId).classList.remove("show");
  });
});
