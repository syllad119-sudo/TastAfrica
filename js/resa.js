// const form = document.getElementById("contactForm");
// const successMessage = document.getElementById("successMessage");

// form.addEventListener("submit", function (e) {
//   e.preventDefault();

//   let isValid = true;

//   // Réinitialiser les erreurs
//   document
//     .querySelectorAll(".error")
//     .forEach((el) => el.classList.remove("error"));
//   document
//     .querySelectorAll(".error-message")
//     .forEach((el) => el.classList.remove("show"));

//   // Validation du nom
//   const nom = document.getElementById("nom");
//   if (nom.value.trim() === "") {
//     nom.classList.add("error");
//     document.getElementById("nomError").classList.add("show");
//     isValid = false;
//   }

//   // Validation du prénom
//   const prenom = document.getElementById("prenom");
//   if (prenom.value.trim() === "") {
//     prenom.classList.add("error");
//     document.getElementById("prenomError").classList.add("show");
//     isValid = false;
//   }

//   // Validation de l'email
//   const email = document.getElementById("email");
//   const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//   if (!emailRegex.test(email.value)) {
//     email.classList.add("error");
//     document.getElementById("emailError").classList.add("show");
//     isValid = false;
//   }

//   // Validation du téléphone
//   const telephone = document.getElementById("telephone");
//   const telRegex = /^[0-9\s\+\-\(\)]{10,}$/;
//   if (!telRegex.test(telephone.value)) {
//     telephone.classList.add("error");
//     document.getElementById("telephoneError").classList.add("show");
//     isValid = false;
//   }

//   // Validation du message
//   const message = document.getElementById("message");
//   if (message.value.trim() === "") {
//     message.classList.add("error");
//     document.getElementById("messageError").classList.add("show");
//     isValid = false;
//   }

//   // Si tout est valide
//   if (isValid) {
//     // Afficher le message de succès
//     successMessage.classList.add("show");

//     // Réinitialiser le formulaire
//     form.reset();

//     // Masquer le message après 5 secondes
//     setTimeout(() => {
//       successMessage.classList.remove("show");
//     }, 5000);

//     // Ici vous pouvez ajouter le code pour envoyer les données à un serveur
//     console.log("Formulaire soumis avec succès!");
//   }
// });

// // Retirer l'erreur lors de la saisie
// document.querySelectorAll("input, textarea").forEach((input) => {
//   input.addEventListener("input", function () {
//     this.classList.remove("error");
//     const errorId = this.id + "Error";
//     document.getElementById(errorId).classList.remove("show");
//   });
// });

// const form = document.getElementById("contactForm")
// const messageDiv =document.getElementById("resultat")
// const nom = document.getElementById("nom")
// const prenom = document.getElementById("prenom")
// const mail = document.getElementById("email")
// const telephone = document.getElementById("telephone")

// const regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
// const regextelephone = /^[0-9]{10}$/;
// let isValid = [false, false, false, false, false];

// // Validation du nom
// contactForm.nom.addEventListener("input", () => {
//   if (contactForm.nom.value.length >= 2 && contactForm.nom.value.length <= 20) {
//     contactForm.nom.classList.remove("danger");
//     contactForm.nom.classList.add("success");
//     contactForm.nom.form-group.classList.add("success-checked");
//     isValid[0] = true;
//   } else {
//     form.nom.classList.remove("success");
//     form.nom.form - group.classList.remove("success-checked");
//     form.nom.classList.add("danger");
//     isValid[0] = false;
//   }
// });

// // Validation du prenom
// contactForm.prenom.addEventListener("input", () => {
//   if (contactForm.prenom.value.length >= 2 && contactForm.prenom.length <= 20) {
//     contactForm.prenom.classList.remove("danger");
//     contactForm.prenom.classList.add("success");
//     contactform.prenom.form-group.classList.add("success-checked");
//     isValid[1] = true;
//   } else {
//     contactForm.prenom.classList.remove("success");
//     contactForm.prenom.parentElement.classList.remove("success-checked");
//     contactForm.prenom.classList.add("danger");
//     isValid[1] = false;
//   }
// });

// // Validation de l'email
// contactForm.email.addEventListener("input", () => {
//   if (regexEmail.test(contactForm.email.value)) {
//     contactForm.email.classList.remove("danger");
//     contactForm.email.classList.add("success");
//     contactForm.email.form-group.classList.add("success-checked");
//     isValid[2] = true;
//   } else {
//     contactForm.email.classList.remove("success");
//     contactForm.email.form - group.classList.remove("success-checked");
//     contactForm.email.classList.add("danger");
//     isValid[2] = false;
//   }
// });
// // Validation de telephone
// contactForm.telephone.addEventListener("input", () => {
//   if (regextelephone.test(contactForm.telephone.value)) {
//     contactForm.telephone.classList.remove("danger");
//     contactForm.telephone.classList.add("success");
//     contactForm.telephone.form-group.classList.add("success-checked");
//     isValid[3] = true;
//   } else {
//     contactForm.telephone.classList.remove("success");
//     contactForm.telephone.form-group.classList.remove("success-checked");
//     contactForm.telephone.classList.add("danger");
//     isValid[3] = false;
//   }
// });

// contactForm.message.addEventListener("input", () => {
//   if (contactForm.message.value.length >= 2 && contactForm.message.length <= 20) {
//     contactForm.message.classList.remove("danger");
//     contactForm.message.classList.add("success");
//     contactform.message.form-group.classList.add("success-checked");
//     isValid[4] = true;
//   } else {
//     contactForm.message.classList.remove("success");
//     contactForm.message.form-group.classList.remove("success-checked");
//     contactForm.message.classList.add("danger");
//     isValid[4] = false;
//   }
// });
// // console.log(contactForm);
// //     console.log("Nom:", nom);
// //     console.log("Prénom:", prenom);
// //     console.log("Email:", email);
// //     console.log("Téléphone:", telephone);
// //     console.log("Message:", message);

// //     // Réinitialiser le formulaire
// //     form.reset();

// // Soumission du formulaire
// contactForm.addEventListener("submit", (e) => {
//     e.preventDefault();

//     if (isValid.every(v => v === true)) {
//         resultat.textContent = "Compte créé avec succès !";
//       resultat.style.color = "green";
//       console.log ("ok")
//     } else {
//       resultat.textContent = "Veuillez remplir tous les champs correctement";
//       resultat.style.color = "red";
//       console.log("ok")
//     }
// });

// // console.log("Données du formulaire:");
// //     console.log("Nom:", nom);
// //     console.log("Prénom:", prenom);
// //     console.log("Email:", email);
// //     console.log("Téléphone:", telephone);
// //     console.log("Message:", message);

// //     // Réinitialiser le formulaire
// //     form.reset();

//     // Cacher le message après 5 secondes

// // // Écouter l'événement de soumission du formulaire
// // form.addEventListener("submit", function (e) {
// //   // Empêcher le rechargement de la page
// //   e.preventDefault();

// //   // Récupérer les valeurs des champs
// //   const nom = document.getElementById("nom").value;
// //   const prenom = document.getElementById("prenom").value;
// //   const email = document.getElementById("email").value;
// //   const telephone = document.getElementById("telephone").value;
// //   const message = document.getElementById("message").value;

// //   // Vérifier que tous les champs sont remplis
// //   if (nom && prenom && email && telephone && message) {
// //     // Afficher un message de succès
// //     messageDiv.textContent =
// //       "Merci " +
// //       prenom +
// //       " " +
// //       nom +
// //       " ! Votre message a été envoyé avec succès.";
// //     messageDiv.className = "message success";
// //     messageDiv.style.display = "block";

// //     // Afficher les données dans la console (pour le développement)
// //     console.log("Données du formulaire:");
// //     console.log("Nom:", nom);
// //     console.log("Prénom:", prenom);
// //     console.log("Email:", email);
// //     console.log("Téléphone:", telephone);
// //     console.log("Message:", message);

// //     // Réinitialiser le formulaire
// //     form.reset();

// //     // Cacher le message après 5 secondes
// //     setTimeout(function () {
// //       messageDiv.style.display = "none";
// //     }, 5000);
// //   } else {
// //     // Afficher un message d'erreur
// //     messageDiv.textContent = "Veuillez remplir tous les champs obligatoires.";
// //     messageDiv.className = "message error";
// //     messageDiv.style.display = "block";
// //   }
// // });

// // Recupereration du formulaire
// // const form = document.getElementById("contactForm");

// // // Recuperation des champs du formulaire
// // const nom = document.getElementById("nom");
// // const prenom = document.getElementById("prenom");
// // const email = document.getElementById("email");
// // const telephone = document.getElementById("telephone");
// // zone de messge de feedback
// // const feedback = document.getElementById("feedback");

// // document.getElementById("contactForm").addEventListener("submit", function(e) {
// //     e.preventDefault(); // Empêche le rechargement de la page

// //     // Récupération des valeurs
// //     let nom = document.getElementById("nom").value.trim();
// //     let email = document.getElementById("email").value.trim();
// //     let message = document.getElementById("message").value.trim();
// //     let telephone = document.getElementById("telephone").value.trim();
// //     let feedback = document.getElementById("feedback");

// //     // Vérification
// //     if (nom === "" || email === "" || message === "" || telephone === "") {
// //         feedback.style.color = "red";
// //         feedback.textContent = "❌ Veuillez remplir tous les champs.";
// //         return;
// //     }

// //     // Vérification simple de l'email
// //     if (!email.includes("@")) {
// //         feedback.style.color = "red";
// //         feedback.textContent = "❌ Email invalide.";
// //         return;
// //     }

// //     // Succès
// //     feedback.style.color = "green";
// //     feedback.textContent = "✅ Message envoyé avec succès !";

// //     // Réinitialiser le formulaire
// //     document.getElementById("contactForm").reset();
// // });
