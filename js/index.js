// To fetch pour recuperer les donnes json

const url = window.location.origin + "/js/data/menu.json";

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
            <p>description: ${data[index].desc}</p>
            <p> <a href="detail.html?id=${data[index].id}">En savoir plus</a> </p>
                       
            `;
      menus.appendChild(article);
      //   console.log(menus);
      // //   console.log(article);
    }
  })
  .catch((error) => {
    console.log(
      "Il y a eu un probleme avec l'operation fetch: " + error.message,
    );
  });
