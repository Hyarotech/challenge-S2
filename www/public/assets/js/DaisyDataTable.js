class DaisyDatatable {


    constructor(element, options = {} ) {
        if (!element) {
            throw new Error('L\'élément de la table est obligatoire');
        }

        // Initialiser les options par défaut
        this.options = {
            scrollY: '400px',
            paging: true,
            language: {
                 url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
            },
            "lengthMenu":[[5,10,25,50,100,-1],[5,10,25,50,100,'All']]

        };
        this.setOptions(options);

        this.element = element;
    }

    init() {
        this.datatable = $(this.element).DataTable(this.options);
    }

    setOptions(options){
        this.options = { ...this.options, ...options };
    }


    getDataTable() {
        if (!this.datatable) {
            throw new Error('Vous devez appeler init() avant de récupérer le DataTable');
        }

        return this.datatable;
    }

    // Vous pouvez ajouter d'autres méthodes ici
}

export default DaisyDatatable;