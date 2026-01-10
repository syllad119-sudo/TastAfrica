// const searchInput = document.getElementById("searchInput");

// // Recherche en temps réel
// searchInput.addEventListener("input", () => {
//   const value = searchInput.value.toLowerCase();
//   console.log(plat);

//   const resultats = plat.filter(item =>
//     item.nom.toLowerCase().includes(value)
//   );

//   afficherMenu(resultats);
// });

// // Fonction pour afficher le menu
// const sortSelect = document.getElementById("sortSelect");

// sortSelect.addEventListener("change", () => {
//   const valeur = sortSelect.value;
//   trierMenu(valeur);
// });

// // Fonctionalité de tri
// function trierMenu(type) {
//   let copie = [...plats];

//   if (type === "asc") {
//     copie.sort((a, b) => a.prix - b.prix);
//   } 
//   else if (type === "desc") {
//     copie.sort((a, b) => b.prix - a.prix);
//   }

//   afficherMenu(copie);
// }
