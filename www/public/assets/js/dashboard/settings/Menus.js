import Component from "/assets/js/Component.js";
import MenuItem from "./MenuItem.js";


class Menu extends Component {
    constructor(menuElement) {
        super();    
        this.listMenuItem = [];
        this.element = menuElement;

        document.querySelector('[data-selector="addItem"]').addEventListener('click', (e) => {
            let menuItem = new MenuItem('page','Non défini','Non défini',this);
            menuItem.render(this.element,false);
        });

        document.querySelector('[data-menu="saveMenu"]')
    }
    menuToJson() {
            const getMenuItems = (parent) => {
                return Array.from(parent.children).map((child) => {
                    const menuItem = {
                        title: child.getAttribute('data-title'),
                        link: child.getAttribute('data-link'),
                        type: child.getAttribute('data-type'),
                    };
                    
                    const childrenElement = child.querySelector('[data-selector="menu-item-childs"]');
                    if (childrenElement) {
                        menuItem.children = getMenuItems(childrenElement);
                    }

                    return menuItem;
                }).filter(item => item.title || item.link || item.type);  // Filtrer les éléments sans données pertinentes
            };

            const menuJson = getMenuItems(this.element);
            const menuJsonString = JSON.stringify(menuJson, null, 2);

            return menuJsonString;
    }

    jsonToMenu(jsonStr) {
        const jsonObj = JSON.parse(jsonStr);
        this.listMenuItem = [];  // Réinitialiser la liste des éléments de menu
    
        const createMenuItemFromData = (itemData, parentMenuItem = null) => {
            // Créer un nouvel objet MenuItem à partir des données JSON
            let newMenuItem = new MenuItem(itemData.type, itemData.title, itemData.link, this);
            
            // Si un parent MenuItem est fourni, ajoutez ce nouveau MenuItem comme enfant
            if (parentMenuItem) {
                parentMenuItem.appendChild(newMenuItem);
            } else {
                // Si aucun parent n'est fourni, cela signifie que nous sommes au niveau de la racine,
                // donc nous ajoutons simplement le nouvel élément au DOM directement
                newMenuItem.render(this.element, false);
            }
    
            // Maintenant, appelez cette même fonction pour chaque enfant (si des enfants existent),
            // en passant le nouvel objet MenuItem comme parent cette fois
            if (itemData.children && itemData.children.length > 0) {
                itemData.children.forEach(childData => {
                    createMenuItemFromData(childData, newMenuItem);
                });
            }
        };
    
        // Initialiser la création d'éléments de menu en partant du niveau racine
        jsonObj.forEach(itemData => {
            createMenuItemFromData(itemData);
        });
    }
    
    
    createMenuItemFromData(itemData, parentMenuItem = null) {
        // Créer un nouvel objet MenuItem à partir des données JSON
        let newMenuItem = new MenuItem(itemData.type, itemData.title, itemData.link, this);
        
        // Si un parent MenuItem est fourni, ajoutez ce nouveau MenuItem comme enfant
        if (parentMenuItem) {
            newMenuItem.render(parentMenuItem,false);
        } else {
            // Si aucun parent n'est fourni, cela signifie que nous sommes au niveau de la racine,
            // donc nous ajoutons simplement le nouvel élément au DOM directement.
            // Remplacez "someParentElement" par l'élément réel où vous voulez ajouter ce MenuItem
            newMenuItem.render(this.element,false);
        }

        // Maintenant, appelez cette même fonction pour chaque enfant (si des enfants existent),
        // en passant le nouvel objet MenuItem comme parent cette fois
        if (itemData.childs && itemData.childs.length > 0) {
            itemData.childs.forEach(childData => {
                this.createMenuItemFromData(childData, newMenuItem);
            });
        }


    }
    

    

    pushMenuItem(menuItem) {
        this.listMenuItem.push(menuItem);
    }
    removeMenuItem(menuItem) {
        this.listMenuItem = this.listMenuItem.filter((item) => {
            return menuItem.id != item.id;
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