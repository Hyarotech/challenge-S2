import HistoryPanel from './panel/HistoryPanel.js';

// Handle tailwind's use of slashes in css names
const escapeName = (name) => `${name}`.trim().replace(/([^a-z0-9\w-:/]+)/gi, '-');

const projectEndpoint = '/api/admin/page/builder/create';
const saveInterval = 1;

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

['h1', 'h2', 'h3', 'h4', 'h5', 'h6'].forEach(tag => {
  editor.DomComponents.addType(tag, {
    model: {
      defaults: {
        name: tag.toUpperCase(),
        tagName: tag,
        draggable: '[data-gjs-type=root], [data-gjs-type=wrapper], [data-gjs-type=column], [data-gjs-type=row]',
        stylable: true,
        'stylable-require': ['display'],
        traits: [
          'id',
          'title',
          'class'
        ],
      },
    },
    view: {},
  });
});

['h1', 'h2', 'h3', 'h4', 'h5', 'h6'].forEach(tag => {
  editor.BlockManager.add(tag, {
    label: tag.toUpperCase(),
    attributes: { class:'gjs-fonts gjs-f-'+ tag },
    content: `<${tag}>Texte de l'entête</${tag}>`,
  });
});

const history = new HistoryPanel(editor);

history.loadLast();
