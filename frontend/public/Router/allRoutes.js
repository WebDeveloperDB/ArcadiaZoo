import Route from "./Route.js";

export const websiteName = "Arcadia Zoo";

export const allRoutes = [
    
    new Route("/", "Accueil", "/pages/home.html", [], "/js/avis/avis.js"),
    new Route("/services", "Nos Services", "/pages/service/services.html", [], "/js/service/services.js"),
    new Route("/habitats", "Nos Habitats", "/pages/habitat/habitats.html", [], "/js/habitat/habitats.js"),
    new Route("/signin", "Connexion", "/pages/auth/signin.html", ["disconnected"], "/js/auth/signin.js"),
    new Route("/contact", "Contact", "/pages/contact.html", [], "/js/contact/contact.js"),
    new Route("/account", "Les comptes", "/pages/auth/account.html", ["admin"]),
    new Route("/adminDashboard", "Dashboard Admin", "/pages/admin/dashboardAdmin.html", ["admin"], "/js/admin/dashboardAdmin.js"),
    new Route("/employeeDashboard", "Dashboard Employé", "/pages/employee/dashboardEmployee.html", ["employee"], "/js/employee/dashboardEmployee.js"),
    new Route("/vetDashboard", "Dashboard Vétérinaire", "/pages/vet/dashboardVeterinaire.html", ["vet"], "/js/vet/dashboardVeterinaire.js"),
];
