import HistoryPanel from './panel/HistoryPanel.js';

// Handle tailwind's use of slashes in css names
const escapeName = (name) => `${name}`.trim().replace(/([^a-z0-9\w-:/]+)/gi, '-');

const projectEndpoint = '/dashboard/page/builder/create';
const saveInterval = 2;

let editor; // Déclaration de la variable pour stocker l'instance de l'éditeur
const storageManagerConfig = {
  type: 'remote',
  stepsBeforeSave: saveInterval,
  options: {
    remote: {
      urlStore: projectEndpoint,
      fetchOptions: opts => {
        if (opts.method === 'POST') {
          opts.body = JSON.parse(opts.body);
          opts.body.computedHTML = editor.getHtml();
          opts.body.computedCSS = editor.getCss();
          opts.body.computedJs = editor.getJs();
          
          const params = new URLSearchParams();
          params.append('page_id', document.getElementById('_page_id').value);
          params.append('state', JSON.stringify(opts.body));
          
          return {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: params.toString(),
          };
        }
        return {};
      },
    },
  },
};

editor = grapesjs.init({
  container: '#gjs',
  height: '100%',
  fromElement: true,
  storageManager: storageManagerConfig,
  selectorManager: { escapeName },
  plugins: ['grapesjs-tailwind'],
});

const history = new HistoryPanel(editor);

history.loadLast();