
async function loadPendingAvis() {
  const res = await fetchWithAuth("http://localhost:8000/api/avis/pending");
  const pendingAvisList = document.getElementById("pending-avis-list");
  if (!pendingAvisList) return;
  if (!res.ok) {
    pendingAvisList.innerHTML = "<div class='alert alert-danger'>Erreur lors du chargement des avis.</div>";
    return;
  }
  const avis = await res.json();
  if (!avis.length) {
    pendingAvisList.innerHTML = "<div class='alert alert-info'>Aucun avis en attente.</div>";
    return;
  }
  pendingAvisList.innerHTML = avis.map(a => `
    <div class="card mb-2 shadow">
      <div class="card-body">
        <h6>${a.pseudo}</h6>
        <p>${a.commentaire}</p>
        <small class="text-muted">${new Date(a.createdAt).toLocaleDateString()}</small>
        <div class="mt-2">
          <button class="btn btn-success btn-sm me-1" onclick="validateAvis(${a.id})">Valider</button>
          <button class="btn btn-danger btn-sm" onclick="deleteAvis(${a.id})">Rejeter</button>
        </div>
      </div>
    </div>
  `).join("");
}

  loadPendingAvis();

async function validateAvis(id) {
  const res = await fetchWithAuth(`http://localhost:8000/api/avis/${id}/validate`, { method: "POST" });
  if (res.ok) {
    loadPendingAvis();
  } else {
    alert("Erreur lors de la validation.");
  }
}

async function deleteAvis(id) {
  const res = await fetchWithAuth(`http://localhost:8000/api/avis/${id}`, { method: "DELETE" });
  if (res.ok) {
    loadPendingAvis();
  } else {
    alert("Erreur lors de la suppression.");
  }
}


async function fetchWithAuth(url, options = {}) {
  const token = localStorage.getItem("getToken"); 
  return fetch(url, {
    ...options,
    headers: {
      ...options.headers,
      "Authorization": `Bearer ${token}`,
      "Content-Type": "application/json",
    },
  });
}
