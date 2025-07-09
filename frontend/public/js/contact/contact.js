const role = typeof getRole === "function" ? getRole() : null;

const contactForm = document.getElementById('contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', submitContactForm);
}

async function submitContactForm(event) {
    event.preventDefault();
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const email = document.getElementById('email').value;

    try {
        // Besucher kein token
        const response = await fetch("/api/contact", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title, description, email })
        });

        if (response.ok) {
            alert('Message envoyé avec succès !');
            contactForm.reset();
        } else {
            const err = await response.json().catch(() => ({}));
            alert('Erreur lors de l\'envoi du message: ' + (err.message || ''));
        }
    } catch (error) {
        alert('Erreur JS côté client: ' + error.message);
    }
}

    fetchContactRequests();

async function fetchContactRequests() {
    try {
  
        const response = await fetchWithAuth("/api/contact/requests");
        if (!response.ok) {
            throw new Error("Erreur lors du chargement (Status: " + response.status + ")");
        }
        const contacts = await response.json();
        displayContactRequests(contacts);
    } catch (error) {
        console.error('Erreur lors de la récupération des demandes de contact :', error);
        const contactList = document.getElementById('contact-list');
        if (contactList) {
            contactList.innerHTML = "<div class='list-group-item text-danger'>Erreur lors du chargement des demandes de contact.</div>";
        }
    }
}

function displayContactRequests(contacts) {
    const contactList = document.getElementById('contact-list');
    if (!contactList) return;
    contactList.innerHTML = '';
    if (!contacts.length) {
        contactList.innerHTML = "<div class='list-group-item text-muted'>Aucune demande de contact.</div>";
        return;
    }
    contacts.forEach(contact => {
        const contactItem = document.createElement('div');
        contactItem.className = 'card mb-3';
        contactItem.innerHTML = `
            <div class="card-body">
                <p><strong>Titre :</strong> ${contact.title}</p>
                <p><strong>Email :</strong> ${contact.email}</p>
                <p><strong>Message :</strong> ${contact.description}</p>
                <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#replyContactModal" data-email="${contact.email}">Répondre</button>
                <button class="btn btn-danger delete-btn" data-id="${contact.id}">Supprimer</button>
            </div>
        `;
        contactList.appendChild(contactItem);
    });


    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            deleteContactRequest(id);
        });
    });
}


async function deleteContactRequest(id) {
    if (!confirm("Demande wirklich löschen?")) return;
    try {
        const token = getToken();
        const response = await fetch(`/api/contact/requests/${id}`, {
            method: 'DELETE',
            headers: {
          "X-AUTH-TOKEN": token
        }
        });
        if (response.ok) {
            alert("Demande supprimée !");
            fetchContactRequests(); 
        } else {
            const err = await response.json().catch(() => ({}));
            alert('Erreur de suppression : ' + (err.message || ''));
        }
    } catch (error) {
        alert('Erreur de suppression : ' + error.message);
    }
}



window.setContactReply = function(email) {
    document.getElementById('contact-email').textContent = email;
}

window.sendReply = async function() {
    const email = document.getElementById('contact-email').textContent;
    const message = document.getElementById('contact-reply-message').value;

    try {
        
        const response = await fetchWithAuth("/api/contact/reply", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, message })
        });

        if (response.ok) {
            alert('Réponse envoyée avec succès !');
            document.getElementById('contact-reply-message').value = '';
        } else {
            const err = await response.json().catch(() => ({}));
            alert('Erreur lors de l\'envoi de la réponse: ' + (err.message || ''));
        }
    } catch (error) {
        alert('Erreur lors de l\'envoi de la réponse: ' + error.message);
    }



}


