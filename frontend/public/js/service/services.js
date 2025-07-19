  loadServices();
// Fonction pour charger et afficher tous les services
  async function loadServices() {
    const token = getToken();
    try {
      const response = await fetch("/api/services", {
        headers: token ? { "X-AUTH-TOKEN": token } : {}
      });
      if (!response.ok) throw new Error("Erreur HTTP : " + response.status);

      const services = await response.json();
      displayServices(services);
    } catch (error) {
      console.error("Erreur chargement services", error);
    }
  }

  // Affiche les services dans le DOM
  function displayServices(services) {
    const container = document.getElementById("services-list");
    container.innerHTML = "";

    services.forEach(service => {
      const card = document.createElement("div");
      card.classList.add("service-card");

      let imagesHtml = "";
      if (service.images && service.images.length > 0) { 
        imagesHtml = service.images.map(img => `<img src="${img.url}" alt="Image" style="max-width: 500px;">`).join("");
      }

      card.innerHTML = `
        <h3>${service.nom}</h3>
        <p>${service.description}</p>
        ${imagesHtml}
        <button class="btn btn-warning edit-service-btn" data-id="${service.id}" data-show="employee">Modifier</button>
        <button class="btn btn-danger delete-service-btn" data-id="${service.id}" data-show="employee">Supprimer</button>
      `;

      container.appendChild(card);
    });

    showAndHideElementsForRoles();
  }

  // 
  document.addEventListener("submit", (e) => {
    if (e.target && e.target.id === "add-service-form") {
      console.log("handleCreateService aufgerufen");
      e.preventDefault();
      handleCreateService(e);
    } else if (e.target && e.target.id === "editServiceForm") { 
      console.log("handleEditService aufgerufen");
      e.preventDefault();
      handleEditService(e);
    }
  });

  //  Logik pour créer
  async function handleCreateService(e) {
    const form = e.target;
    const token = getToken();
    const nom = form.querySelector("#add-service-nom").value;
    const description = form.querySelector("#add-service-description").value;
    const images = form.querySelector("#add-service-images").files;

    const formData = new FormData();
    formData.append("nom", nom);
    formData.append("description", description);
    for (let i = 0; i < images.length; i++) {
      formData.append("images[]", images[i]);
    }

    try {
      const response = await fetch("/api/services", {
        method: "POST",
        headers: {
          "X-AUTH-TOKEN": token
        },
        body: formData
      });
      if (!response.ok) throw new Error("Erreur ajout");

      await loadServices();
      form.reset();
      const modal = bootstrap.Modal.getInstance(document.getElementById("addServiceModal"));
      modal.hide();
    
    } catch (error) {
      console.error("Erreur ajout service", error);
    }
  }



  // Edit-Handler
 async function handleEditService(e) {
  const form = e.target;
  const token = getToken();
  const id = document.getElementById("edit-service-id").value;
  const nom = form.querySelector("#edit-service-name").value;
  const description = form.querySelector("#edit-service-description").value;
  const images = form.querySelector("#edit-service-images").files;

  const formData = new FormData();
  formData.append("_method", "PUT");
  formData.append("nom", nom);
  formData.append("description", description);
  for (let i = 0; i < images.length; i++) {
    formData.append("images[]", images[i]);
  }

  try {
    const response = await fetch(`/api/services/${id}`, {
      method: "POST", 
      headers: {
        "X-AUTH-TOKEN": token
      },
      body: formData
    });

    if (!response.ok) throw new Error("Erreur modification");

    await loadServices();
    const modal = bootstrap.Modal.getInstance(document.getElementById("editServiceModal"));
    modal.hide();
  } catch (error) {
    console.error("Erreur modification", error);
  }
}



  // ✅ Delete-Handler
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("delete-service-btn")) {
      const id = e.target.dataset.id;
      if (!confirm("Supprimer ce service ?")) return;

      const token = getToken();
      fetch(`/api/services/${id}`, {
        method: "DELETE",
        headers: {
          "X-AUTH-TOKEN": token
        }
      })
        .then((response) => {
          if (!response.ok) throw new Error("Erreur suppression");
          return loadServices();
        })
        .catch((error) => console.error("Erreur suppression", error));
    } else if (e.target.classList.contains("edit-service-btn")) {
      prepareEditModal(e);
    }
  });

  //  Edit Modal vorbereiten
  function prepareEditModal(e) {
    const id = e.target.dataset.id;
    document.getElementById("edit-service-id").value = id;
    const card = e.target.closest(".service-card");
    document.getElementById("edit-service-name").value = card.querySelector("h3").textContent;
    document.getElementById("edit-service-description").value = card.querySelector("p").textContent;

    const modal = new bootstrap.Modal(document.getElementById("editServiceModal"));
    modal.show();
  }











