import DaisyDatatable from "/assets/js/DaisyDataTable.js";
import Alert from "/assets/js/Components/Alert.js";
class PageTable extends DaisyDatatable {
    constructor(element, options = {}) {
        super(element, options);
        this.initDeleteHandler();
        this.initEditCategoryHandler();
    }

    initDeleteHandler() {
        $(this.element).on('click', '.delete-page', (event) => {
            let id = $(event.currentTarget).closest('.page-row').data('id');
            this.deletePage(id);
        });
    }
    initEditCategoryHandler() {
        $(this.element).on('change', 'select[name="editCategories"]', (event) => {
            let page_id = $(event.currentTarget).closest('.page-row').data('id');
            let category_id = event.currentTarget.value;
            this.changeCategory(page_id,category_id);
        });
    }

    deletePage(id) {
        let table = this.getDataTable();
        let deleteAlert = new Alert();
        $.post('/api/admin/page/delete', {id: id}, (data) => {
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
            deleteAlert.createElement();
            deleteAlert.render(document.querySelector('#app'));  
        });
    }

    changeCategory(page_id, category_id) {
        let alertCat = new Alert();
        $.post('/api/admin/page/edit_categories', {page_id: page_id,category_id: category_id}, (data) => {
            if (data.success == true){
                alertCat.setType('success');
                alertCat.setMessage('La catégorie a bien été modifiée');
            }
            else{
                alertCat.setType('error');
                alertCat.setMessage('La catégorie n\'a pas été modifiée');
            }
        }).fail((data) => {
            alertCat.setType('error');
            alertCat.setMessage('Une erreur est survenue lors de l\'ajout de la catégorie');
           
        }).always(() => {
            alertCat.createElement();
            alertCat.render(document.querySelector('#app'));  
        });
    }
}

export default PageTable;
