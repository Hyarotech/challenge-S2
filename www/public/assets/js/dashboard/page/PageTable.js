import DaisyDatatable from "/assets/js/DaisyDataTable.js";
import Alert from "/assets/js/Components/Alert.js";
class PageTable extends DaisyDatatable {
    constructor(element, options = {}) {
        super(element, options);
        this.initDeleteHandler();
    }

    initDeleteHandler() {
        $(this.element).on('click', '.delete-page', (event) => {
            let id = $(event.currentTarget).closest('.page-row').data('id');
            this.deletePage(id);
        });
    }

    deletePage(id) {
        let table = this.getDataTable();
        let deleteAlert = new Alert();
        $.post('/dashboard/page/delete', {id: id}, (data) => {
            if (data.success == true){
                table.row('.page-row[data-id="' + id + '"]').remove().draw(false);
                deleteAlert.setType('success');
                deleteAlert.setMessage('La page a bien été supprimée');
            }
            else{
                deleteAlert.setType('error');
                deleteAlert.setMessage('La page à supprimer n\'a pas été trouvée');
            }
        }).fail((data) => {

            deleteAlert.setType('error');
            deleteAlert.setMessage('Une erreur est survenue lors de la suppression');
           
        }).always(() => {
            deleteAlert.render(document.querySelector('#app'));  
        });
    }
}

export default PageTable;
