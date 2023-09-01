class Sidebar {
    #sideElement = null;

    constructor() {
      this.setElement();
    }
    
    sideHideEventClick() {
        // Ajouter un événement de clic sur .sidebarMobileHide pour basculer la classe hidden
        this.getElement().find('.sidebarMobileHide button').on('click', () => {
            this.getElement().toggleClass('hidden');
        });
      
    }
    setElement(){
        if(this.#sideElement !== null) return this.getElement();
        this.#sideElement = $('.sidebar');
        this.sideHideEventClick();
    }

    getElement() {
        return this.#sideElement;   
    }
 
}
  
// Exporter une seule instance de Navbar
export default new Sidebar();
  