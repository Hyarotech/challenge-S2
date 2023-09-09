import Menu from './Menus.js';
import MenuItem from './MenuItem.js';

let menu = new Menu(document.getElementById('menuList'));
let menuItem = new MenuItem('page','Non défini','Non défini',menu);
menuItem.render(menu.element);
