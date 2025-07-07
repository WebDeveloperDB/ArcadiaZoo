function getToken() {
    const match = document.cookie.match('(^|;)\\s*accesstoken\\s*=\\s*([^;]+)');
    return match ? match.pop() : null;
}

function fetchWithAuth(url, options = {}) {
    const token = getToken();
    options.headers = options.headers || {};
    if (token) {
        options.headers['Authorization'] = `Bearer ${token}`;
    }
    return fetch(url, options);
}

async function createUser() {
    const token = getToken();
    console.log("Admin-Token:", token);

    if (!token) {
        alert("Vous n'êtes pas connecter en tant que administrateur ! Veuillez d'abord vous connecter.");
        return;
    }

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;

    try {
        const response = await fetchWithAuth('http://localhost:8000/api/admin/create-user', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ email, password, role })
        });

        if (!response.ok) {
            let errorData = {};
            try {
                errorData = await response.json();
            } catch (e) {}
            throw new Error(errorData.message || "L'utilisateur n'a pas pu être créé.");
        }

        alert("Utilisateur créé avec succès !");
       
    } catch (err) {
        alert("Erreur lors de la création : " + err.message);
        console.error(err);
    }
}





async function loadUsers() {
    const token = getToken();
    try {
        const response = await fetch("http://localhost:8000/api/admin/users", {
            headers: {
                "X-AUTH-TOKEN": token
            }
        });
        const users = await response.json();

        const userList = document.getElementById("userList");
        userList.innerHTML = "";

        users.forEach(user => {
            const div = document.createElement("div");
            div.innerHTML = `<strong>${user.email}</strong> - ${user.role}`;
            userList.appendChild(div);
        });
    } catch (error) {
        console.error("Erreur lors du chargement des utilisateurs :", error);
    }
}

async function updateUser() {
    const token = getToken();
    const email = document.getElementById("update-email").value;
    const password = document.getElementById("update-password").value;
    const role = document.getElementById("update-role").value;

    if (!email) {
        alert("Veuillez d’abord sélectionner un utilisateur dans la liste !");
        return;
    }

    try {
        const response = await fetch(`http://localhost:8000/api/admin/users/${email}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-AUTH-TOKEN": token
            },
            body: JSON.stringify({ email, password, role })
        });
        let result = {};
        try { result = await response.json(); } catch (e) {}
        if (response.ok) {
            alert("L'utilisateur a été mis à jour avec succès !");
            document.getElementById("updateUserForm").reset();
            loadUsers();
        } else {
            alert("Fehler: " + (result.message || "La mise à jour a échoué."));
        }
    } catch (error) {
        alert("Fehler: " + error.message);
    }
}




async function deleteUser() {
    const token = getToken();
    const email = document.getElementById("update-email").value;
    if (!confirm(`⚠️ Supprimer ${email} ?`)) return;

    try {
        const response = await fetch(`http://localhost:8000/api/admin/users/${email}`, {
            method: "DELETE",
            headers: {
                "X-AUTH-TOKEN": token
            }
        });

        const result = await response.json();
        if (response.ok) {
            alert("✅ Utilisateur supprimé !");
            loadUsers();
            document.getElementById("updateUserForm").reset();
        } else {
            alert("❌ Erreur : " + (result.message || "Suppression impossible."));
        }
    } catch (error) {
        console.error("Erreur suppression :", error);
    }

}

async function loadConsultationsStats() {
    const token = getToken();
    try {
        const response = await fetch("http://localhost:8000/api/consultations", {
            headers: {
                "X-AUTH-TOKEN": token
            }
        });
        const data = await response.json();

        const container = document.getElementById('consultationStats');
        container.innerHTML = '';

        data.forEach(item => {
            const el = document.createElement('div');
            el.classList.add('list-group-item');
            el.textContent = `Animal : ${item.animalName ?? item.animalId} | Consultations : ${item.count}`;
            container.appendChild(el);
        });
    } catch (error) {
        console.error("Erreur chargement statistiques :", error);
    }
}



loadConsultationsStats();

loadUsers();



