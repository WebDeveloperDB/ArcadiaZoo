const tokenCookieName = "accesstoken";
const RoleCookieName = "role";
const signoutBtn = document.getElementById("signout-btn");

// Token und Rolle holst du zentral!
function getToken() {
    return getCookie(tokenCookieName);
}

function getRole() {
    return getCookie(RoleCookieName);
}

function signout() {
    eraseCookie(tokenCookieName);
    eraseCookie(RoleCookieName);
    window.location.reload();
}

function setToken(token) {
    setCookie(tokenCookieName, token, 7);
}

function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (const element of ca) {
        let c = element;
        while (c.startsWith(' ')) c = c.substring(1, c.length);
        if (c.startsWith(nameEQ)) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function isConnected() {
    return getToken() !== null;
}

// Allgemeine Fetch-Funktion mit Token
async function fetchWithAuth(url, options = {}) {
    const token = getToken();
    const headers = {
        ...options.headers,
        'X-AUTH-TOKEN': token,
    };
    return fetch(url, { ...options, headers });
}

// Funktion um Elemente je nach Rolle ein oder auszublenden
function showAndHideElementsForRoles() {
    const userConnected = isConnected();
    const role = getRole(); // "ROLE_ADMIN", "ROLE_EMPLOYEE"

    document.querySelectorAll('[data-show]').forEach(element => {
        
        let allowed = element.dataset.show.split(",").map(r => r.trim().toLowerCase());
        let show = false;

        
        if (allowed.includes('disconnected') && !userConnected) {
            show = true;
        }
       
        else if (allowed.includes('connected') && userConnected) {
            show = true;
        }
        // Rollen prüfen (nur wenn eingeloggt)
        else if (userConnected && role) {
            const roleName = role.replace("ROLE_", "").toLowerCase();
            if (allowed.includes(roleName)) {
                show = true;
            }
        }

        
        if (show) {
            element.classList.remove("d-none");
        } else {
            element.classList.add("d-none");
        }
    });
}


// EventListener für das Signout-Button
signoutBtn.addEventListener("click", signout);



