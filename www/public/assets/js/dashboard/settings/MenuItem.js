import Component from "/assets/js/Component.js";
import MenuForm from "./MenuForm.js";
import { randString } from "../../helper.js";
class MenuItem extends Component {
    constructor(type = 'page',title,link,menu) {
        super();    
        this.menu = menu;
        this.title = title;
        this.link = link;
        this.type = type;
        this.createElement(title,link);
        this.menu.pushMenuItem(this);
    }
    menuItemToJson() {
        let childsJson = [];
    
        const childsElement = this.element.querySelector('[data-selector="menu-item-childs"]');
        const childsArray = Array.from(childsElement.children);
        childsArray.forEach(child => {
            const childItem = this.menu.getMenuItemById(child.getAttribute('data-id'));
            if (childItem) {
                childsJson.push(childItem.menuItemToJson());
            }
        });
    
        return {
            title: this.title,
            type: this.type,
            link: this.link,
            childs: childsJson,
        };
    }
    saveMenuEvent(){
        
    }
    getElement() {
        return this.element;
    }
    toContainsChildsStyle(element = null){
        element = element ?? this.element;
        element.querySelector('[data-selector="menu-item-main"]').className =  "card flex flex-row p-3 justify-between bg-base-300";
    }
    toNotContainsChildsStyle(element = null){
        element = element ?? this.element;
        element.querySelector('[data-selector="menu-item-main"]').className =  "card flex flex-row p-3 justify-between bg-base-100";

    }
    appendChild(menuItem){
        this.toContainsChildsStyle();
        this.element.querySelector('[data-selector="menu-item-childs"]').appendChild(
            menuItem.getElement()
        );
    }
    
    // Je préfère utiliser des data-* plutôt que des classes pour ce qui est du comportemental je préfère dédier les classes au style
    addItemChildEvent(){
        this.element.querySelector('[data-selector="menu-item-main"] [data-selector="addChild"]').addEventListener('click', (e) => {
            e.preventDefault();
            let menuItem = new MenuItem('page','','',this.menu);
            this.appendChild(menuItem);
        });
    }
    updateValue(){
        this.element.setAttribute('data-title',this.title);
        this.element.setAttribute('data-link',this.link);
        this.element.setAttribute('data-type',this.type);
        this.element.querySelector('[data-selector="menu-item-main"] p').textContent = this.title;
    }
    addItemEvent(){
        this.element.querySelector('[data-selector="menu-item-main"] [data-selector="add"]').addEventListener('click', (e) => {
            e.preventDefault();
            let menuItem = new MenuItem('page','','',this.menu);
            this.element.after(menuItem.getElement());
        });
    }
    editItemEvent(){
        this.element.querySelector('[data-selector="menu-item-main"] [data-selector="edit"]').addEventListener('click', (e) => {
            e.preventDefault();
            let menuForm = new MenuForm(this);
            menuForm.removeAllElementWithNameComponent();
            menuForm.render(document.getElementById('app'),false);
        });
    }

    upItemEvent(){
        this.element.querySelector('[data-selector="menu-item-main"] [data-selector="up"]').addEventListener('click', (e) => {
            let previousElement = null;
            
            if(this.element.parentElement.id == "menuList"){
                previousElement = this.element.previousElementSibling;
                if(previousElement == null)
                    return true;
            }
            
            previousElement = this.element.previousElementSibling;
            if(previousElement == null){
                this.element.parentElement.parentElement.before(this.element);   
                this.menu.updateMenuChilds();
                return true;
            }
            previousElement.before(this.element);
            this.menu.updateMenuChilds();
            
        });
    }

    downItemEvent(){
        this.element.querySelector('[data-selector="menu-item-main"] [data-selector="down"]').addEventListener('click', (e) => {
            let previousElement = null;
            
            if(this.element.parentElement.id == "menuList"){
                previousElement = this.element.nextElementSibling;
                if(previousElement == null)
                    return true;
            }
            
            previousElement = this.element.nextElementSibling;
            if(previousElement == null){
                this.element.parentElement.parentElement.after(this.element); 
                this.menu.updateMenuChilds();  
                return true;
            }
            previousElement.after(this.element);
            this.menu.updateMenuChilds();
        });
    }

    removeItemEvent(){
        this.element.querySelector('[data-selector="menu-item-main"] [data-selector="remove"]').addEventListener('click', (e) => {
            let parentItem = this.getElement().parentElement;
            this.remove();
            if(parentItem.childElementCount <= 0){
                this.toNotContainsChildsStyle(parentItem.parentElement)
            }
            
        });

        
    }
   

    createElement() {
        if(this.element instanceof HTMLElement)
            this.element.remove();
            

            this.element = new DOMParser().parseFromString(
                `<div data-id="${this.id}" data-type="page" data-link="" data-title="" class="flex flex-col" data-selector="menu-item">
                    <div class="card flex flex-row p-3 justify-between bg-base-100" data-selector="menu-item-main">
                        <p>`+randString(20)+`</p>
                        <div class="flex gap-2">
                            <button data-selector="remove" title="Supprimer le lien" class="btn btn-xs btn-error btn-circle btn-outline">
                            <i class="fa-solid fa-trash"></i>
                            </button>
                            <button data-selector="edit" title="Modifier le lien" class="btn btn-xs btn-info btn-circle btn-outline">
                                    <i class="fa-solid fa-pen"></i>
                            </button>
                            <button data-selector="add" title="Ajouter un lien" class="btn btn-xs btn-success btn-circle btn-outline">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <button data-selector="addChild" title="Ajouter un lien enfant" class="btn btn-xs btn-primary btn-circle btn-outline">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                            <button data-selector="down" title="Descendre le lien" class="btn btn-xs btn-circle btn-outline">
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <button data-selector="up" title="Monter le lien" class="btn btn-xs btn-circle btn-outline">
                            <i class="fa-solid fa-chevron-up"></i>
                            </button>
                        </div>
                    </div>
                
                <div class="my-2 flex flex-col pl-4" data-selector="menu-item-childs">
                        
                </div>     
                      
                
            </div>`
        , "text/html").body.firstChild;
        
        this.addItemChildEvent();
        this.addItemEvent();
        this.editItemEvent();
        this.removeItemEvent();
        this.upItemEvent();
        this.downItemEvent();
    }
    
    remove(){
        this.menu.removeMenuItem(this);
        this.removeElement();
        delete this;
    }   
    
}

export default MenuItem;