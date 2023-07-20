import routes from "/assets/js/routing/routes.js";
export default async () => {
    let path = window.location.pathname;
    if(!path.includes("/install"))
        window.location = "/install/step1";
    const page = routes[path];
    return await page();
}