import Component from "/assets/js/Component.js";

class MenuForm extends Component {

    constructor(menuItem) {
        super();    
        this.menuItem = menuItem;
        this.title = menuItem.title;
        this.link = menuItem.link;
        this.type = menuItem.type;
        this.NAME_COMPONENT = 'GES-menu-form';
        this.pageList = JSON.parse(document.getElementById('GES_PAGE_LIST').textContent);
        this.createElement();
    }
    
    positionToEditButton() {
        const editButton = this.menuItem.element.querySelector('[data-selector="edit"]');
        const rect = editButton.getBoundingClientRect();
        let x = rect.x + window.scrollX;
        let y = rect.y + rect.height + window.scrollY;
        this.element.style.left = x-100 + 'px';
        this.element.style.top = y-50 + 'px';        
    }
    
    closeEvent(){
        this.element.querySelector('[data-selector="close"]').addEventListener('click', (e) => {
            this.remove();
        });
    }

    validateEvent(){
        this.element.querySelector('[name="validate"]').addEventListener('click', (e) => {
            this.menuItem.title = this.element.querySelector('[name="title"]').value;
            this.menuItem.link = this.element.querySelector('[name="link"]').value;
            this.menuItem.type = this.element.querySelector('[name="url_type"]:checked').value;
            this.menuItem.updateValue();
            this.element.querySelector('[data-selector="close"]').click();
        });
    }
    
    createPageList() {
        const container = document.createElement('div');
     
        container.className = 'card max-h-full overflow-y-auto absolute top-0 right-[-65%] [100px]card bg-base-300 p-2';
        const displayClass = this.menuItem.type == "page" ? "block" : "none";
        this.pageList.forEach(page => {
            const pageItem = document.createElement('div');
            pageItem.textContent = page.title;
            pageItem.dataset.id = page.id;
            pageItem.dataset.title = page.title;
            pageItem.style.cursor = 'pointer';
            pageItem.className = 'px-2 py-1 hover:bg-base-200 rounded-md';
            pageItem.addEventListener('click', (e) => {
                const { title, id } = e.currentTarget.dataset;
                this.element.querySelector('[name="title"]').value = title;
                this.element.querySelector('[name="link"]').value = id;
            });
            container.appendChild(pageItem);
            
        });
        
        return container;
    }

    createElement() {
        if(this.element instanceof HTMLElement)
            this.element.remove();

        this.element = new DOMParser().parseFromString(
            `<form class="card `+this.NAME_COMPONENT+` bg-base-300 max-h-[230px] absolute gap-2 p-5 flex self-start">
            <div class="relative content">
                <input type="text" placeholder="Titre" value="`+this.menuItem.title+`" name="title" class="input w-full max-w-xs" />
                <div class="flex flex-row">
                    <div class="form-control">
                            <label class="label cursor-pointer gap-2">
                                <span class="label-text">Page</span> 
                                <input type="radio" value="page" name="url_type" class="radio checked:bg-primary" checked />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer gap-2 ">
                                <span class="label-text">Lien</span> 
                                <input type="radio" value="url" name="url_type" class="radio checked:bg-primary" checked />
                            </label>
                        </div>
                </div>
                <input type="text" placeholder="Lien" name="link" value="`+this.menuItem.link+`" class="input input-sm w-full max-w-xs" />
                <div class = "flex justify-end gap-2">
                    <button type="button" data-selector="close" class="btn mt-3 btn-sm btn-error">Close</button>
                    <button type="button" name="validate" class="btn  mt-3 btn-sm btn-primary">Valider</button>
                </div>
            </div>
        </form>`
    , "text/html").body.firstChild;


        if(this.menuItem.type == "page")
            this.element.querySelector('[value="page"]').checked = true;
        const pageListContainer = this.createPageList();
        this.element.querySelector('.content').appendChild(pageListContainer);

        this.element.querySelector('[value="page"]').addEventListener('change', () => {
            pageListContainer.style.display = 'block';
            this.menuItem.type = "page";
        });
        this.element.querySelector('[value="url"]').addEventListener('change', () => {
            pageListContainer.style.display = 'none';
            this.menuItem.type = "url";
        });

        this.closeEvent();
        this.validateEvent();
        this.positionToEditButton();
    }
    
    remove(){
        this.removeElement();
        delete this;
    }   
    
}

export default MenuForm;
