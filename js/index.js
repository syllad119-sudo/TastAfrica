// To fetch pour recuperer les donnes json

const url = "http://127.0.0.1:5501/js/data/menu.json";

const menus = document.querySelector("#menus");

// methode fetch

fetch(url)
  .then((response) => {
    console.log(response);
    return response.json(); //recup de fichier json
  })
  .then((data) => {
    console.log(data);
    console.log(data[0].name); //affichage du fichier json7
    // parcourir le tableau et crée des elements pour chaque mois
    for (let index = 0; index < data.length; index++) {
      console.log(index);

      const article = document.createElement("article");
      article.classList = "menu";
      article.style.backgroundColor = "#BF7E04";
      article.innerHTML = `
            <img src="${data[index].image}" alt="${data[index].name}" >
            <h2>${data[index].name}</h2> 
            <p>Prix: ${data[index].price} € </p>
            <p>Categorie: ${data[index].categorie} </p>
           
            `;
      menus.appendChild(article);
      //   console.log(menus);
      // //   console.log(article);
    }
  })

  .catch((error) => {
    console.log(
      "Il y a eu un probleme avec l'operation fetch: " + error.message
    );
  });

// Pour le formulaire de contact
// const contactForm = document.querySelector("#contactform");
// const contactFeedback = document.querySelector("#contactFeedback");
// contactForm.addEventListener("submit", function (event) {
//   event.preventDefault(); // Empecher le comportement par defaut du formulaire
//   contactFeedback.textContent = "Merci pour votre message. Nous vous recontacterons sous peu.";
//   contactForm.reset(); // Reinitialiser le formulaire
// });

// const contactForm = document.getElementById("contactForm");
// const feedback = document.getElementById("contactFeedback");

// contactForm.addEventListener("submit", (e) => {
//   e.preventDefault();

//   const nom = document.getElementById("nom").value.trim();
//   const email = document.getElementById("email").value.trim();
//   const message = document.getElementById("message").value.trim();

//   if (!nom || !email || !message ) {
//     feedback.textContent = "❌ Veuillez remplir tous les champs";
//     feedback.style.color = "red";
//     return;
//   }

//   feedback.textContent = "✅ Merci pour votre message, nous vous répondrons bientôt !";
//   feedback.style.color = "green";

//   contactForm.reset();
// });

// ajouter bouton au panier //

// let panier = [];

// function ajouterAuPanier(id) {
//   const plat = plats.find((p) => p.id === id);
//   panier.push(plat);
//   afficherPanier();
// }

// function afficherPanier() {
//   const panierListe = document.getElementById("panierListe");
//   const totalEl = document.getElementById("total");

//   panierListe.innerHTML = "";
//   let total = 0;

//   panier.forEach((item, index) => {
//     total += item.prix;
//     panierListe.innerHTML += `
//       <li>
//         ${item.nom} - ${item.prix} €
//         <button onclick="supprimerDuPanier(${index})">❌</button>
//       </li>
//     `;
//   });

//   totalEl.textContent = `Total : ${total} €`;
// }

// function supprimerDuPanier(index) {
//   panier.splice(index, 1);
//   afficherPanier();
// }
