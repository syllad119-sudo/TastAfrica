const openBtn = document.getElementById("openReservation");
const modal = document.getElementById("reservationModal");
const closeBtn = document.getElementById("closeReservation");
const submitBtn = document.getElementById("submitReservation");

// Ouvrir la modal
openBtn .addEventListener ("click", () => { modal.style.display = "block";
});

// Fermer la modal
closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

// Confirmer la réservation
const contactForm = document.getElementById("contactForm");
const feedback = document.getElementById("contactFeedback");

contactForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const nom = document.getElementById("Nom").value.trim();
  const email = document.getElementById("Email").value.trim();
  const message = document.getElementById("Message").value.trim();
  const telephone = document.getElementById("telephone").value.trim();

  if (!nom || !email || !message || !telephone) {
    feedback.textContent = "❌ Veuillez remplir tous les champs";
    feedback.style.color = "red";
    return;
  }

  feedback.textContent =
    "✅ Merci pour votre message, nous vous répondrons bientôt !";
  feedback.style.color = "green";

  contactForm.reset();
});

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