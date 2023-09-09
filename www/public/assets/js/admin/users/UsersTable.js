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
        $.delete(`/api/admin/users/${id}`, (data) => {
            if (data.success){
                table.row('.user-row[data-id="' + id + '"]').remove().draw(false);
                deleteAlert.setType('success');
                deleteAlert.setMessage('La page a bien été supprimée');
            }
            else{
                deleteAlert.setType('error');
                deleteAlert.setMessage('L\'utilisateur à supprimer n\'a pas été trouvé');
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
