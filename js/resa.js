const openBtn = document.getElementById("openReservation");
const modal = document.getElementById("reservationModal");
const closeBtn = document.getElementById("closeReservation");
const submitBtn = document.getElementById("submitReservation");

// Ouvrir la modal
openBtn.addEventListener("click", () => {
  modal.style.display = "block";
});

// Fermer la modal
closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

// Confirmer la réservation
submitBtn.addEventListener("click", () => {
  const nom = document.getElementById("nom").value;
  const date = document.getElementById("date").value;
  const heure = document.getElementById("heure").value;
  const personnes = document.getElementById("personnes").value;

  if (!nom || !date || !heure || !personnes) {
    alert("Veuillez remplir tous les champs");
    return;
  }

  alert(
    `Merci ${nom} !\nVotre table pour ${personnes} personnes est réservée le ${date} à ${heure}.`
  );

  modal.style.display = "none";
});