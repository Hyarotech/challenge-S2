import createElement from '/assets/js/vdom/createElement.js'
import render from '/assets/js/vdom/render.js';
import mount from '/assets/js/vdom/mount.js';
import diff from '/assets/js/vdom/diff.js';
import browserRouter from "/assets/js/routing/BrowserRouter.js";

// browserRouter();
const createVApp = async () => {
    let data = await browserRouter();
    return createElement(data);
}

let vApp = await createVApp();
const $app = render(vApp);

let $rootEl = mount($app, document.getElementById('root'));
window.addEventListener('popstate', async (data) => {
    const vNewApp = await createVApp();
    console.log(vNewApp);
    const patch = diff(vApp, vNewApp);
    $rootEl = patch($rootEl);
    vApp = vNewApp;
});



