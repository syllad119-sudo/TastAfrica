const searchInput = document.getElementById("searchInput");

// Recherche en temps réel
searchInput.addEventListener("input", () => {
  const value = searchInput.value.toLowerCase();

  const resultats = plats.filter(item =>
    item.nom.toLowerCase().includes(value)
  );

  console.log(resultats);
});
