import createElement from '/assets/js/vdom/createElement.js'
import render from '/assets/js/vdom/render.js';
import mount from '/assets/js/vdom/mount.js';
import diff from '/assets/js/vdom/diff.js';


const createVApp = () => {
	return createElement('div', {
       children:[
           "Hello World",
       ]
    });
}

let vApp = createVApp();
const $app = render(vApp);

let $rootEl = mount($app, document.getElementById('root'));

setInterval(() => {
    const vNewApp = createVApp();
    const patch = diff(vApp, vNewApp);
    $rootEl = patch($rootEl);
    vApp = vNewApp;
}, 1000);