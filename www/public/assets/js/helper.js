function randString(longueur) {
    let resultat = '';
    let caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let caracteresLongueur = caracteres.length;

    for (let i = 0; i < longueur; i++) {
        resultat += caracteres.charAt(Math.floor(Math.random() * caracteresLongueur));
    }

    return resultat;
}
function generateUniqueID() {
    return Date.now().toString(36) + Math.random().toString(36).substring(2);
  }
  
export {randString, generateUniqueID};