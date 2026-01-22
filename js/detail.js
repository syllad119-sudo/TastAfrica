 // Récupérer l'ID du menu depuis l'URL
      const urlParams = new URLSearchParams(window.location.search);
      const menuId = urlParams.get("id");
      console.log("Menu ID:", menuId);

      const url = window.location.origin + "/js/data/menu.json";

      let menuDetail = document.getElementById("menu-detail");
      fetch(url)
        .then((reponse) => reponse.json()) 
        .then((data) => {
          console.log(data);

          // Trouver l'élément du menu par ID
          const menu = data.find((item) => item.id == menuId);
          if (!menu) {
            menuDetail.innerHTML = "<p>Menu non trouvé.</p>";
            return;
          }

          const article = document.createElement("article");
          article.classList = "detail";

          article.innerHTML = `
            <img src="${menu.image}" alt="${menu.name}">
            <h2>${menu.name}</h2>
            <p>Prix: ${menu.price} €</p>
            <p>Catégorie: ${menu.categorie}</p>
            <P>desc: ${menu.desc}</p>
            <p>createdAt: ${menu.date}<p/>
          `;

          menuDetail.appendChild(article);
        });