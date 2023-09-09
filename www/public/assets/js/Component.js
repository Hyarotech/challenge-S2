import { generateUniqueID } from "./helper.js";
class Component {
    constructor() {
        this.element = null;
        this.NAME_COMPONENT = null; // Nom du composant pour le supprimer facilement dans le dom
        this.elementClass = [];
        this.id = generateUniqueID();
    }

    removeAllElementWithNameComponent(){
        const elements = document.querySelectorAll('.'+this.NAME_COMPONENT);
        elements.forEach(element => {
            element.remove();
        });
    }
    createElement() {
        throw new Error("Method 'createElement' must be implemented in derived classes.");
    }

    addClass(className) {
        if(!this.elementClass.includes(className)) {
            this.elementClass.push(className);
        }
    }

    removeClass(className) {
        this.elementClass = this.elementClass.filter(value => value !== className);
    }

    getClassString() {
        return this.elementClass.join(' ');
    }

    render(insideElement, isPrepend = true) {
        if (isPrepend) 
            insideElement.prepend(this.element);
        else 
             insideElement.appendChild(this.element);
        
    }


    removeElement() {
        if (this.element !== null) {
            this.element.remove();
            this.element = null;
        }
    }
}

export default Component;
