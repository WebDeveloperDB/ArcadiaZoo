document.getElementById("btnSignin").addEventListener("click", async () => {
    const email = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    console.log("Tentative de connexion avec :", email, password); // Vérifie que les valeurs sont bien récupérées

    const response = await fetch("http://localhost:8000/api/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            username: email,
            password: password
        })
    });

    const data = await response.json();
    console.log("Réponse reçue :", data); // Vérifie ce que retourne l'API

    if (response.ok) {
        console.log("Connexion réussie !");
        setToken(data.apiToken);
        setCookie("role", data.roles[0], 7);
        window.location.href = "/"; // Redirige vers le dashboard
    } else {
        alert("Erreur de connexion: " + data.message);
    }
});

