import Alert from './Components/Alert.js';


function deleteCommentaireEvent(element){
    let ciblingForAlert = element.parentElement;
    let id = element.getAttribute('data-id');
    let deleteAlert = new Alert();
    // Créez un objet URLSearchParams pour stocker vos données de formulaire
    const formData = new URLSearchParams();
    formData.append('id', id); // Ajoutez les données que vous souhaitez envoyer

    // Ensuite, effectuez la requête POST avec les données de formulaire
    fetch(`/api/comment/delete`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: formData.toString(), // Convertissez l'objet formData en une chaîne de requête
    })
    .then((response) => {
        if (!response.ok) {
            throw new Error('Une erreur est survenue lors de la suppression');
        }
        return response.json();
    })
    .then((data) => {
        if (data.success) {
            deleteAlert.setType('success');
            deleteAlert.setMessage('Le commentaire a bien été supprimée');
            element.remove();
        } else {
            deleteAlert.setType('error');
            deleteAlert.setMessage('Le commentaire à supprimer n\'a pas été trouvée');
        }
    })
    .catch((error) => {
        deleteAlert.setType('error');
        deleteAlert.setMessage('Le commentaire à supprimer n\'a pas été trouvée');
    })
    .finally(() => {
        deleteAlert.createElement();
        deleteAlert.render(ciblingForAlert,false);
    });

}



const listeCommentaire = document.querySelectorAll('.ges-commentaire-box');

for (let i = 0; i < listeCommentaire.length; i++) {
    listeCommentaire[i].querySelector('[data-action="delete"]').addEventListener('click', () => {
        deleteCommentaireEvent(listeCommentaire[i]);
    });
}