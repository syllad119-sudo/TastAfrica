const form = document.getElementById("contactForm");
const messageDiv = document.getElementById("messageDiv");

// Écouter l'événement de soumission du formulaire
form.addEventListener("submit", function (e) {
  // Empêcher le rechargement de la page
  e.preventDefault();

  // Récupérer les valeurs des champs
  const nom = document.getElementById("nom").value;
  const prenom = document.getElementById("prenom").value;
  const email = document.getElementById("email").value;
  const telephone = document.getElementById("telephone").value;
  const message = document.getElementById("message").value;

  // Vérifier que tous les champs sont remplis
  if (nom && prenom && email && telephone && message) {
    // Afficher un message de succès
    messageDiv.textContent =
      "Merci " +
      prenom +
      " " +
      nom +
      " ! Votre message a été envoyé avec succès.";
    messageDiv.className = "message success";
    messageDiv.style.display = "block";

    // Afficher les données dans la console (pour le développement)
    console.log("Données du formulaire:");
    console.log("Nom:", nom);
    console.log("Prénom:", prenom);
    console.log("Email:", email);
    console.log("Téléphone:", telephone);
    console.log("Message:", message);

    // Réinitialiser le formulaire
    form.reset();

    // Cacher le message après 5 secondes
    setTimeout(function () {
      messageDiv.style.display = "none";
    }, 5000);
  } else {
    // Afficher un message d'erreur
    messageDiv.textContent = "Veuillez remplir tous les champs obligatoires.";
    messageDiv.className = "message error";
    messageDiv.style.display = "block";
  }
});

// Recupereration du formulaire
// const form = document.getElementById("contactForm");

// // Recuperation des champs du formulaire
// const nom = document.getElementById("nom");
// const prenom = document.getElementById("prenom");
// const email = document.getElementById("email");
// const telephone = document.getElementById("telephone");
// zone de messge de feedback
// const feedback = document.getElementById("feedback");

// document.getElementById("contactForm").addEventListener("submit", function(e) {
//     e.preventDefault(); // Empêche le rechargement de la page

//     // Récupération des valeurs
//     let nom = document.getElementById("nom").value.trim();
//     let email = document.getElementById("email").value.trim();
//     let message = document.getElementById("message").value.trim();
//     let telephone = document.getElementById("telephone").value.trim();
//     let feedback = document.getElementById("feedback");

//     // Vérification
//     if (nom === "" || email === "" || message === "" || telephone === "") {
//         feedback.style.color = "red";
//         feedback.textContent = "❌ Veuillez remplir tous les champs.";
//         return;
//     }

//     // Vérification simple de l'email
//     if (!email.includes("@")) {
//         feedback.style.color = "red";
//         feedback.textContent = "❌ Email invalide.";
//         return;
//     }

//     // Succès
//     feedback.style.color = "green";
//     feedback.textContent = "✅ Message envoyé avec succès !";

//     // Réinitialiser le formulaire
//     document.getElementById("contactForm").reset();
// });
