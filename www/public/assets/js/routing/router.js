import routes from './routes.js';
const getRouteFromUrl = (url) => {
    for (const route of routes) {
        if (route.url === url) {
            return route;
        }
    }

    return null;
};

const navigateToRoute = (name) => {
    const route = getRouteFromUrl(name);

    if (route === null) {
        return;
    }

    window.location.href = route.url;
};