
fetchAndDisplayHabitats();


document.addEventListener("submit", (e) => {
  if (e.target && e.target.id === "addHabitatForm") {
    
    handleCreateHabitat(e);
  }

  if (e.target && e.target.id === "edit-habitat-form") {
    handleEditHabitat(e);
  }

  if (e.target && e.target.id === "add-animal-form") {
    handleCreateAnimal(e);
  }

  if (e.target && e.target.id === "edit-animal-form") {
    handleEditAnimal(e);
  }
});

//  Créer un habitat
async function handleCreateHabitat(e) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);

  try {
    const response = await fetch("http://localhost:8000/api/habitats", {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      const err = await response.json();
      console.error("Erreur lors de la création de l'habitat :", err);
      return;
    }

    const result = await response.json();
    console.log("Habitat créé :", result);
    form.reset();
    const modal = bootstrap.Modal.getInstance(document.getElementById("addHabitatModal"));
    modal.hide();
    fetchAndDisplayHabitats();
  } catch (err) {
    console.error(" JS-Fehler:", err);
  }
}

// Modifier l'habitat
async function handleEditHabitat(e) {
  e.preventDefault();
  const form = e.target;
  const id = form.dataset.id;
  const formData = new FormData(form);
  formData.append("_method", "PUT");

  try {
    const response = await fetch(`http://localhost:8000/api/habitats/${id}`, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      const err = await response.json();
      console.error("Erreur lors de l'édition de l'habitat :", err);
      return;
    }

    const updated = await response.json();
    console.log("Habitat mis à jour :", updated);
    const modal = bootstrap.Modal.getInstance(document.getElementById("editHabitatModal"));
    modal.hide();
    fetchAndDisplayHabitats();
  } catch (err) {
    console.error("JS-Fehler beim PUT:", err);
  }
}

// Habitat supprimer
function deleteHabitat(id) {
  if (!confirm("Supprimer vraiment l’habitat ?")) return;

  fetch(`http://localhost:8000/api/habitats/${id}`, {
    method: "DELETE",
  })
    .then(res => {
      if (!res.ok) throw new Error("Erreur de suppression ");
      return res.json();
    })
    .then(() => {
      console.log(" Habitat supprimé");
      fetchAndDisplayHabitats();
    })
    .catch(err => console.error("Erreur de suppression :", err));
}

// Créer un animal
async function handleCreateAnimal(e) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);


  formData.append("habitat_id", formData.get("habitat"));
  formData.delete("habitat");

  
  if (formData.getAll("images[]").length > 0 && formData.getAll("images[]")[0]) {
    formData.append("image", formData.getAll("images[]")[0]);
  }
  formData.delete("images[]");

  
  console.log("FormData check:", [...formData.entries()]);


  if (
    !formData.get("prenom") ||
    !formData.get("description") ||
    !formData.get("habitat_id")
  ) {
    alert("Tous les champs doivent être remplis !");
    return;
  }

  try {
    const response = await fetch("http://localhost:8000/api/animals", {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      const error = await response.json();
      console.error("Erreur lors de la création d'Animal :", error);
      alert(error.message || "Erreur lors de la création de l'animal !");
      return;
    }

    const newAnimal = await response.json();
    form.reset();
    bootstrap.Modal.getInstance(document.getElementById("addAnimalModal")).hide();
    fetchAndDisplayHabitats();
    console.log("Nouvel animal créé :", newAnimal);
  } catch (err) {
    console.error("Erreur lors de Animal POST:", err);
    alert("Erreur dans le POST animal");
  }
}




// 🔄 Modifier un animal
async function handleEditAnimal(e) {
  e.preventDefault();
  const form = e.target;
  const id = form.dataset.id;
  const formData = new FormData(form);
  formData.append("_method", "PUT");

  try {
    const response = await fetch(`http://localhost:8000/api/animals/${id}`, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      const error = await response.json();
      console.error("Erreur lors de l'édition de Animal:", error);
      return;
    }

    const updated = await response.json();
    console.log("Animal mis à jour :", updated);
    const modal = bootstrap.Modal.getInstance(document.getElementById("editAnimalModal"));
    modal.hide();
    fetchAndDisplayHabitats();
  } catch (err) {
    console.error("Animal PUT-erreur:", err);
  }
}

// 🗑 Supprimer un animal
function deleteAnimal(id) {
  if (!confirm("L'animal vraiment supprimer ?")) return;

  fetch(`http://localhost:8000/api/animals/${id}`, {
    method: "DELETE",
  })
    .then(res => {
      if (!res.ok) throw new Error("Erreur lors de la suppression de l'animal");
      return res.json();
    })
    .then(() => {
      console.log("Animal supprimer");
      fetchAndDisplayHabitats();
    })
    .catch(err => console.error("❌ Animal Delete Error:", err));
}

// 📊 MongoDB: Consultation statistique
function trackAnimalConsultation(animalId) {
  fetch("http://localhost:8000/api/consultations", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ animalId }),
  })
    .then(res => res.json())
    .then(data => console.log("Statistiques MongoDB enregistrées :", data))
    .catch(err => console.error("MongoDB Erreur:", err));
}




//  Affichage des habitats
async function fetchAndDisplayHabitats() {
  try {
    const res = await fetch("http://localhost:8000/api/habitats");
    if (!res.ok) throw new Error("Erreur lors du chargement des habitats");
    const habitats = await res.json();

    const container = document.getElementById("habitat-list");
    if (!container) return;
    container.innerHTML = "";

    habitats.forEach(habitat => {
      
      let habitatImgHtml = "";
      if (habitat.images && habitat.images.length > 0) {
        const habitatImgUrl = `http://localhost:8000${habitat.images[0].url.replace(/\\/g, "")}`;
        habitatImgHtml = `<img src="${habitatImgUrl}" alt="${habitat.nom}" class="img-fluid mb-2 rounded shadow-sm d-block mx-auto" style="max-height: 220px; width: 100%; object-fit: cover;">`;
      }

      // Animaux dans Habitat 
      let animalsHtml = "";
      if (habitat.animaux && habitat.animaux.length > 0) {
        animalsHtml = habitat.animaux.map(animal => {
          // Animal image 
          let animalImgHtml = "";
          if (animal.images && animal.images.length > 0) {
            const animalImgUrl = `http://localhost:8000${animal.images[0].url.replace(/\\/g, "")}`;
            animalImgHtml = `<img src="${animalImgUrl}" alt="${animal.prenom}" class="rounded me-3" style="width: 100px; height: 80px; object-fit: cover; box-shadow: 0 2px 10px #0001;">`;
          }
          return `
            <li class="d-flex align-items-center mb-2 border-bottom pb-2 animal-item" data-animal-id="${animal.id}">
              ${animalImgHtml}
              <div class="flex-grow-1">
                <strong>${animal.prenom}</strong>
                <span class="badge bg-secondary ms-2">${animal.etat ?? ""}</span>
                <br>
                <small class="text-muted">
                  Race: ${animal.race?.nom ?? "Inconnu"}
                </small>
                <div class="fst-italic">${animal.description ?? ""}</div>
              </div>
              <button class="btn btn-sm btn-warning ms-2 edit-animal-btn" data-id="${animal.id}" data-bs-toggle="modal" data-bs-target="#editAnimalModal">✏️</button>
              <button class="btn btn-sm btn-danger ms-1 delete-animal-btn" data-id="${animal.id}">🗑</button>
            </li>
          `;
        }).join("");
        animalsHtml = `<ul class="list-unstyled">${animalsHtml}</ul>`;


      }

  
      const div = document.createElement("div");
      div.className = "card mb-3 p-3 shadow-sm";
      div.innerHTML = `
        ${habitatImgHtml}
        <h5>${habitat.nom}</h5>
        <p>${habitat.description}</p>
        <button class="btn btn-sm btn-primary me-1 edit-habitat-btn" data-id="${habitat.id}" data-bs-toggle="modal" data-bs-target="#editHabitatModal">✏️ Modifier</button>
        <button class="btn btn-sm btn-danger delete-habitat-btn" data-id="${habitat.id}">🗑 Supprimer</button>
        <hr>
        <h6>Tiere:</h6>
        ${animalsHtml}
        <button class="btn btn-sm btn-success mt-2 add-animal-btn" data-habitat-id="${habitat.id}" data-bs-toggle="modal" data-bs-target="#addAnimalModal">➕ Ajouter un animal</button>
      `;

     
      const outerDiv = document.createElement("div");
      outerDiv.className = "col-12 col-md-6 col-lg-4";
      outerDiv.appendChild(div);
      container.appendChild(outerDiv);

    });

    document.querySelectorAll(".animal-item").forEach(item => {
        item.addEventListener("click", (e) => {
        const animalId = item.dataset.animalId;
        trackAnimalConsultation(animalId);
        e.stopPropagation(); 
    });
});


    activateDynamicButtons();
  } catch (err) {
    console.error("Erreur de fetchAndDisplayHabitats:", err);
  }
}


// Enregistrer les boutons dynamiquement
function activateDynamicButtons() {
  // 🏕️ Habitat modifier
  document.querySelectorAll(".edit-habitat-btn").forEach(btn => {
    btn.addEventListener("click", async () => {
      const id = btn.dataset.id;
      const form = document.getElementById("edit-habitat-form");
      form.dataset.id = id;

      try {
        const res = await fetch(`http://localhost:8000/api/habitats/${id}`);
        if (!res.ok) throw new Error("Erreur lors du chargement de l'habitat");
        const habitat = await res.json();

        form.querySelector("[name='nom']").value = habitat.nom || "";
        form.querySelector("[name='description']").value = habitat.description || "";

        if (habitat.images && habitat.images.length > 0) {
          const imgPreview = form.querySelector("#edit-habitat-image-preview");
          if (imgPreview) {
            imgPreview.src = `http://localhost:8000${habitat.images[0].url.replace(/\\/g, "")}`;
            imgPreview.style.display = "block";
          }
        }
      } catch (err) {
        console.error("Erreur lors du pré remplissage d'Habitat :", err);
      }
    });
  });

  // 🗑 Habitat supprimer
  document.querySelectorAll(".delete-habitat-btn").forEach(btn => {
    btn.addEventListener("click", () => deleteHabitat(btn.dataset.id));
  });

  // 🐾 Animal modifier
  document.querySelectorAll(".edit-animal-btn").forEach(btn => {
    btn.addEventListener("click", async () => {
      const id = btn.dataset.id;
      const form = document.getElementById("edit-animal-form");
      form.dataset.id = id;

      try {
        const res = await fetch(`http://localhost:8000/api/animals/${id}`);
        if (!res.ok) throw new Error("Erreur lors du chargement de l'animal");
        const animal = await res.json();

        form.querySelector("[name='prenom']").value = animal.prenom || "";
        form.querySelector("[name='description']").value = animal.description || "";
       



        if (animal.images && animal.images.length > 0) {
          const imgPreview = form.querySelector("#edit-animal-image-preview");
          if (imgPreview) {
            imgPreview.src = `http://localhost:8000${animal.images[0].url.replace(/\\/g, "")}`;
            imgPreview.style.display = "block";
          }
        }
      } catch (err) {
        console.error("Erreur lors du pré remplissage de l'animal :", err);
      }
    });
  });

  // Animal supprimer
  document.querySelectorAll(".delete-animal-btn").forEach(btn => {
    btn.addEventListener("click", () => deleteAnimal(btn.dataset.id));
  });

  // Animal ajouter
  document.querySelectorAll(".add-animal-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const form = document.getElementById("add-animal-form");
      form.reset();
      form.querySelector("[name='habitat']").value = btn.dataset.habitatId;
    });
  });
}