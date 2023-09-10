import DaisyDatatable from "/assets/js/DaisyDataTable.js";
import Alert from "/assets/js/Components/Alert.js";
class UsersTable extends DaisyDatatable {
    constructor(element, options = {}) {
        super(element, options);
        this.initDeleteHandler();
    }

    initDeleteHandler() {
        $(this.element).on('click', '.delete-user', (event) => {
            let id = $(event.currentTarget).closest('.user-row').data('id');
            this.deleteUser(id);
        });
    }

    deleteUser(id) {
        let table = this.getDataTable();
        let deleteAlert = new Alert();
        $.post(`/api/admin/users/delete`,{id:id}, (data) => {
            if (data.success){
                table.row('.user-row[data-id="' + id + '"]').remove().draw(false);
                deleteAlert.setType('success');
                deleteAlert.setMessage('L\'utilisateur a bien été supprimée');
            }
        }).fail((data) => {

            deleteAlert.setType('error');
            deleteAlert.setMessage('Une erreur est survenue lors de la suppression');
           
        }).always(() => {
            deleteAlert.render(document.querySelector('#app'));  
        });
    }
}

export default UsersTable;
