import Route from "./Route.js";

export const websiteName = "Arcadia Zoo";

export const allRoutes = [
    
    new Route("/", "Accueil", "/pages/home.html", [], "/js/avis/avis.js"),
    new Route("/services", "Nos Services", "/pages/service/services.html", [], "/js/service/services.js"),
    new Route("/habitats", "Nos Habitats", "/pages/habitat/habitats.html", [], "/js/habitat/habitats.js"),
    new Route("/signin", "Connexion", "/pages/auth/signin.html", ["disconnected"], "/js/auth/signin.js"),
    new Route("/contact", "Contact", "/pages/contact.html", [], "/js/contact/contact.js"),
    new Route("/account", "Les comptes", "/pages/auth/account.html", ["ROLE_ADMIN"]),
    new Route("/adminDashboard", "Dashboard Admin", "/pages/admin/dashboardAdmin.html", ["ROLE_ADMIN"], "/js/admin/dashboardAdmin.js"),
    new Route("/employeeDashboard", "Dashboard Employé", "/pages/employee/dashboardEmployee.html", ["ROLE_EMPLOYEE"], "/js/employee/dashboardEmployee.js"),
];
