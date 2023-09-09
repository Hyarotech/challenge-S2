import Component from "/assets/js/Component.js";

class MenuForm extends Component {

    constructor(menuItem) {
        super();    
    
        this.menuItem = menuItem;
        this.title = menuItem.element.getAttribute('data-title');
        this.link = menuItem.element.getAttribute('data-link');
        this.type = menuItem.element.getAttribute('data-type');
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
    createElement() {
        if(this.element instanceof HTMLElement)
            this.element.remove();

            this.element = new DOMParser().parseFromString(
                `<form class="card `+this.NAME_COMPONENT+` bg-base-300 max-h-[230px] absolute gap-2 p-5 flex self-start">
                <input type="text" placeholder="Titre" class="input w-full max-w-xs" />
                <div class="flex flex-row">
                    <div class="form-control">
                            <label class="label cursor-pointer gap-2">
                                <span class="label-text">Page</span> 
                                <input type="radio" value="0" name="url_type" class="radio checked:bg-primary" checked />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer gap-2 ">
                                <span class="label-text">Lien</span> 
                                <input type="radio" value="1" name="url_type" class="radio checked:bg-primary" checked />
                            </label>
                        </div>
                </div>
                <input type="text" placeholder="Lien" class="input input-sm w-full max-w-xs" />
                <div class = "flex justify-end gap-2">
                    <button type="button" data-selector="close" class="btn mt-3 btn-sm btn-error">Close</button>
                    <button type="button" class="btn  mt-3 btn-sm btn-primary">Ajouter</button>

                </div>
            </form>`
        , "text/html").body.firstChild;
        this.closeEvent();
        this.positionToEditButton();
    }
    
    remove(){
        this.removeElement();
        delete this;
    }   
    
}

export default MenuForm;