const categorySelect = document.getElementById("categorySelect");
      const dataFiltered = document.getElementById("dataFiltered");
      // dataFiltered va contenir les menus a afficher

      let allmenus = [];
      fetch(url)
        .then((res) => res.json())
        .then((data) => {
          allmenus = data;
          dataFiltered = allmenus;
          console.log(data);
         });

      categorySelect.addEventListener("change", function () {
        menus.innerHTML = "";
        const categorieChoisie = categorySelect.value;
        let dataFiltered;
        if (categorieChoisie === "all") {
          dataFiltered = allmenus;
        } else {
          dataFiltered = allmenus.filter(
            (item) => item.categorie === categorieChoisie
          );
        }

        console.log(dataFiltered);
        for (let index = 0; index < dataFiltered.length; index++) {
          console.log(index);

          const article = document.createElement("article");
          article.classList = "menu";
          article.style.backgroundColor = "#BF7E04";
          article.innerHTML = `
            <img src="${dataFiltered[index].image}" alt="${dataFiltered[index].name}" >
            <h2>${dataFiltered[index].name}</h2>
            <p>Prix: ${dataFiltered[index].price} €</p>
            <p>Categorie: ${dataFiltered[index].categorie}</p>
            <p>description: ${dataFiltered[index].desc}</p>
            <p>createdAt: ${dataFiltered[index].date}</p>
            <p> <a href="detail.html?id=${dataFiltered[index].id}">En savoir plus</a> </p>

            `;
          menus.appendChild(article);
        }
      });
