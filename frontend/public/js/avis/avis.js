const avisForm = document.getElementById("avis-form");

if (avisForm) {
  

  avisForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const pseudoInput = avisForm.querySelector("[name='pseudo']");
    const commentaireInput = avisForm.querySelector("[name='commentaire']");

    const pseudo = pseudoInput?.value.trim();
    const commentaire = commentaireInput?.value.trim();

    if (!pseudo || !commentaire) {
      alert("Veuillez remplir tous les champs.");
      return;
    }

    const data = { pseudo, commentaire };

    try {
      const res = await fetch("/api/avis", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });

      if (!res.ok) {
        const err = await res.json();
        throw new Error(err.message || "Erreur serveur.");
      }

      const json = await res.json();
      console.log("✅ Avis enregistré :", json);

      avisForm.reset();
      alert("Merci pour votre avis !");
      // Liste neu laden
      fetchValidatedAvis();
    } catch (error) {
      console.error("❌ Erreur lors de l'envoi :", error);
      alert("Erreur : impossible d'enregistrer l'avis.");
    }
  });
} else {
  console.warn("❌ Formulaire #avis-form introuvable dans le DOM.");
}


fetchValidatedAvis();

async function fetchValidatedAvis() {
  const res = await fetch("/api/avis/validated");
  if (!res.ok) return;
  const avisList = await res.json();
  const listDiv = document.getElementById("avis-list");
  if (!listDiv) return;
  
  listDiv.innerHTML = avisList.map(avis => `
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card shadow">
        <div class="card-body">
          <h6 class="card-title">${avis.pseudo}</h6>
          <p class="card-text">${avis.commentaire}</p>
          <small class="text-muted">${avis.createdAt ? new Date(avis.createdAt).toLocaleDateString() : ""}</small>
        </div>
        
      </div>
    </div>
  `).join("");
}

