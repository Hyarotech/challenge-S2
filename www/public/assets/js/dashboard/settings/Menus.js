import Component from "/assets/js/Component.js";
import MenuItem from "./MenuItem.js";


class Menu extends Component {
    constructor(menuElement) {
        super();    
        this.listMenuItem = {};
        this.element = menuElement;
    }

    pushMenuItem(menuItem) {
        this.listMenuItem.push(menuItem);
    }
    removeMenuItem(menuItem) {
        this.listMenuItem = this.listMenuItem.filter((item) => {
            return JSON.parse(item) != JSON.parse(menuItem);
        });
    }
    getMenuItemById(id){
        return this.listMenuItem.find((item) => {
            return item.id == id;
        });
    }
    updateMenuChilds() {
        this.listMenuItem.map((objet) => {
                
                const childBox = objet.element.querySelector('[data-selector="menu-item-childs"]');
                if(childBox.childElementCount > 0)
                    objet.toContainsChildsStyle();
                else
                    objet.toNotContainsChildsStyle();
        });
    }
    
    getListItem() {
        return this.listItem;   
    }
    
} 
export default Menu;