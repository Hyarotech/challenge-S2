export default class HistoryPanel {
  constructor(editor) {
    this.editor = editor;
    this.historyList = null; // Stocke la référence de la liste d'historique
    this.addButton();
    this.historyInterval = null;
  }

  fetchData = async (url) => {
    try {
      const response = await fetch(url, {
        headers: {
          'Content-Type': 'application/json',
        },
      });
      if (response.ok) {
        const data = await response.json();
        return data;
      } else {
        throw new Error('Erreur lors de la requête');
      }
    } catch (error) {
      console.error('Erreur lors de la requête :', error);
    }
  };
  loadLast = async () => {
    const pageId = document.getElementById('_page_id').value;
    const url = `/api/admin/page/builder/history/last/${pageId}`;
    const data = await this.fetchData(url);
    if (data) {
      this.editor.loadProjectData(JSON.parse(data.state));
    }
  };

  createItemList = (data) => {
    const items = data.map((item) => ({
      id: item.id,
      createdAt: item.createdAt,
    }));
    
    let list = document.createElement('ul');
    list.setAttribute('class', 'history-list');
    list.classList.add('p-5');
    items.forEach((item) => {
      const listItem = document.createElement('li');
      listItem.classList.add('flex');
      const deleteButton = document.createElement('button');
      const itemBtn = document.createElement('button');
      deleteButton.classList.add('w-1/2', 'text-red-500');
      deleteButton.setAttribute('style','max-width:20%;')
      deleteButton.appendChild(document.createTextNode('Suppr'));
      deleteButton.addEventListener('click', (e) => {
        this.deleteHistoryItem(item.id);
        e.target.parentNode.remove();
      });
      itemBtn.classList.add('btn','mt-2','no-animation');
      itemBtn.setAttribute('style','max-width:80%;')
      itemBtn.setAttribute('data-id', item.id);
      itemBtn.textContent = item.createdAt;
      itemBtn.addEventListener('click', () => this.itemClickEvent(itemBtn));
      listItem.appendChild(itemBtn);
      listItem.appendChild(deleteButton);
      list.appendChild(listItem);
    });
    return list;
  };

  itemClickEvent = async (listItem) => {
    const itemId = listItem.getAttribute('data-id');
    const url = `/api/admin/page/builder/get/${itemId}`;
    const data = await this.fetchData(url);
    if (data) {
      this.editor.clearDirtyCount();
      this.editor.loadProjectData(JSON.parse(data.state));
    }
  };

  displayItemList = (list) => {
    const viewContainer = document.querySelector('.gjs-pn-views-container');
    viewContainer.appendChild(list);
    this.historyList = list;

  }

   deleteHistoryItem = async (id) => {
   
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/api/admin/page/builder/delete', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200)
          return true;
         else 
          return false;
      }
    };
    
    const data = 'id=' + encodeURIComponent(id);
    xhr.send(data);
  
  }
  
  clearItemList() {
      $('.history-list').remove();
      $(this.historyList).remove();
      this.historyList = null;
  }
  
  handleHistoryButton = async () => {
    const pageId = document.getElementById('_page_id').value;
    const url = `/api/admin/page/builder/history/${pageId}`;
    const data = await this.fetchData(url);
    if (data) {
      const itemList = this.createItemList(data);
      this.clearItemList();
      this.displayItemList(itemList);
    }
  };
  refreshList = async () => {
    this.historyInterval = setTimeout(async () => {
      await this.handleHistoryButton();
      this.refreshList();
    }, 2000);
  }
  clearRefreshList(){
      clearTimeout(this.historyInterval);
  }
  addButton() {
    const panels = this.editor.Panels;
    panels.addButton('views', {
      id: 'history-button',
      className: 'fa fa-history history-button',
      command: {
        run: (editor, sender) => {
          this.handleHistoryButton();
          this.clearRefreshList();
          this.refreshList();
        },
        stop: (editor, sender) => {
          console.log('stop');
          this.clearItemList();
          this.clearRefreshList();
        }
      },
      
      attributes: { title: 'Historique' },
      active: false, // Définit le bouton comme inactif par défaut
      togglable: false, // Permet de rendre le bouton bascule (activable/désactivable)
    });
  }
  
  
 
}
