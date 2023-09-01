class Navbar {
    #navElement = null;

    constructor() {
      this.setElement();

    }

    
    navMobileClickEvent() {
        const mobileToggleNav = this.getElement().find('.mobileToggleNav');
        const sidebar = $('.sidebar')
        
        // Ajouter un événement de clic sur le bouton mobileToggleNav
        mobileToggleNav.on('click', function() {
            sidebar.removeClass('hidden');
        });
    
      
    }
    setElement(){
        if(this.#navElement !== null) return this.getElement();
        this.#navElement = $('.navbar');
        this.navMobileClickEvent();
    }

    getElement() {
        return this.#navElement;   
    }
 
}
  
// Exporter une seule instance de Navbar
export default new Navbar();
  