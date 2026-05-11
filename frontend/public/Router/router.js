// router.js
import Route from "./Route.js";
import { allRoutes, websiteName } from "./allRoutes.js";

const route404 = new Route("404", "Page introuvable", "/pages/404.html", []);

const appBasePath = (() => {
  const base = new URL("../", import.meta.url).pathname;
  return base.endsWith("/") && base !== "/" ? base.slice(0, -1) : base;
})();

window.APP_BASE_PATH = appBasePath;

const toAppUrl = (path) => {
  const normalizedPath = path === "/" ? "/" : `/${path.replace(/^\/+/, "")}`;
  if (appBasePath === "/") {
    return normalizedPath;
  }
  return normalizedPath === "/" ? `${appBasePath}/` : `${appBasePath}${normalizedPath}`;
};

const fromAppUrl = (pathname) => {
  if (appBasePath !== "/" && pathname.startsWith(appBasePath)) {
    const stripped = pathname.slice(appBasePath.length);
    return stripped === "" ? "/" : stripped;
  }
  return pathname || "/";
};

const toAssetUrl = (assetPath) => {
  if (appBasePath === "/") {
    return assetPath;
  }
  return `${appBasePath}${assetPath}`;
};

const getRouteByUrl = (url) => {
  let currentRoute = null;
  allRoutes.forEach((element) => {
    if (element.url == url) {
      currentRoute = element;
    }
  });
  return currentRoute || route404;
};

const LoadContentPage = async () => {
  const path = fromAppUrl(window.location.pathname);
  const actualRoute = getRouteByUrl(path);

  const allRolesArray = actualRoute.authorize;
  if (allRolesArray.length > 0) {
    if (allRolesArray.includes("disconnected")) {
      if (isConnected()) window.location.replace(toAppUrl("/"));
    } else {
      const roleUser = getRole();
      if (!allRolesArray.includes(roleUser)) {
        window.location.replace(toAppUrl("/"));
      }
    }
  }

  const html = await fetch(toAssetUrl(actualRoute.pathHtml)).then((data) => data.text());
  document.getElementById("main-page").innerHTML = html;

  if (actualRoute.pathJS != "") {
    const scriptTag = document.createElement("script");
    scriptTag.setAttribute("type", "text/javascript");
    scriptTag.setAttribute("src", toAssetUrl(actualRoute.pathJS));
    scriptTag.onload = () => {
      console.log(`${actualRoute.pathJS} geladen und Events registriert`);
    };
    document.querySelector("body").appendChild(scriptTag);
  }

  document.title = actualRoute.title + " - " + websiteName;
  showAndHideElementsForRoles();
};

const routeEvent = (event) => {
  event = event || window.event;
  const anchor = event.target.closest("a[href]");
  if (!anchor) {
    return;
  }

  const href = anchor.getAttribute("href");
  if (!href || href.startsWith("http") || href.startsWith("mailto:") || href.startsWith("#")) {
    return;
  }

  event.preventDefault();
  window.history.pushState({}, "", toAppUrl(href));
  LoadContentPage();
};

window.onpopstate = LoadContentPage;
window.route = routeEvent;
document.addEventListener("click", routeEvent);
LoadContentPage();
