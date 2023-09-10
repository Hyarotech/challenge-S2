import DaisyDatatable from "/assets/js/DaisyDataTable.js";
import Alert from "/assets/js/Components/Alert.js";
class CategoriesTable extends DaisyDatatable {
    constructor(element, options = {}) {
        super(element, options);
        this.initDeleteHandler();
    }

    initDeleteHandler() {
        $(this.element).on('click', '.delete-category', (event) => {
            let id = $(event.currentTarget).closest('.category-row').data('id');
            this.deleteCategory(id);
        });
    }

    deleteCategory(id) {
        let table = this.getDataTable();
        let deleteAlert = new Alert();
        $.post(`/api/admin/categories/delete`,{id:id}, (data) => {
            if (data.success){
                table.row('.category-row[data-id="' + id + '"]').remove().draw(false);
                deleteAlert.setType('success');
                deleteAlert.setMessage('La catégorie a bien été supprimée');
            }
            else{
                deleteAlert.setType('error');
                deleteAlert.setMessage('La catégorie à supprimer n\'a pas été trouvé');
            }
        }).fail((data) => {

            deleteAlert.setType('error');
            deleteAlert.setMessage('Une erreur est survenue lors de la suppression');

        }).always(() => {
            deleteAlert.render(document.querySelector('#app'));
        });
    }
}

export default CategoriesTable;
