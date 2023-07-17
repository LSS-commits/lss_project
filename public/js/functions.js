/* EMPECHER LE RECHARGEMENT DE LA PAGE ET ENVOYER LES DONNEES DU FORMULAIRE AU CONTROLLER AU FORMAT JSON */
const submitForm = function (form, errorField, fileUrl, ...fields) {

    // si le formulaire existe
    if(form){
    
        form.addEventListener('submit', function (event){

            // empêcher le rechargement de la page lorsque le formulaire est envoyé
            event.preventDefault();

            // pour mettre à jour la page sans la recharger et recevoir ou envoyer des données du serveur
            let client = new XMLHttpRequest();

            client.onreadystatechange = function() {
                // succès de la requête (requête terminée/DONE et réponse prête (user agent, message envoyé par le navig pour permettre l'identification) ET status de la réponse OK (serveur))
                if (this.readyState === 4 && this.status === 200) {
                    
                    // rediriger vers l'url de la réponse
                    let redirectUrl = this.responseURL;
                    // utiliser History API pour rediriger sans recharger la page en manipulant l'historique du navigateur
                    history.replaceState(null, null, redirectUrl);

                    // avec replaceState, pas de retour possible vers page de connexion (retour vers page d'accueil si clic sur précédent)

                    // remplacer le contenu de la page par le corps de la réponse
                    let page = document.querySelector('html');
                    page.innerHTML = this.responseText;

                }else if(this.readyState === 4 && this.status === 400){
                    // si la réponse renvoie un code 400 (Bad Request), afficher les erreurs
                    // n'afficher que les messages générés dans les controllers (sont avant le rendu du contenu HTML)
                    // séparer la chaîne reçue et récup le premier du tableau (= messages)
                    let resp = this.responseText.split('<!DOCTYPE html>');
                    errorField.innerHTML = resp[0];
                }
            };


            // convertir les données du formulaire en objet JSON
            let data = fields.reduce((a, v) => ({...a, [v.name]: v.value}), {});
            data = JSON.stringify(data);

            // envoyer les données au controller, dans la requête, au format JSON
            client.open("POST", fileUrl, true);
            client.setRequestHeader("Content-Type", "application/json");
            client.send(data);
        });
    }
}

/* VALIDATION (affichage des messages d'erreur lors de la saisie) */
const validateForm = function (form, errorField, errorsList) {

    if (form) {
        // vérifier le formulaire lors de la saisie
        form.addEventListener('input', function () {
            // pas de message si le formulaire est valide
            errorField.innerHTML = '';

            // tableau contenant tous les champs input du formulaire
            let checkInputs = form.querySelectorAll('input');

            // si champs input sont invalides, bordure rouge et message d'erreur
            checkInputs.forEach(checkInput => {
                if (checkInput.value !== ''){
                    // si le champ n'est pas valide (regex pattern dans les balises html)
                    if (checkInput.checkValidity() == false){
                        // mettre une bordure rouge
                        checkInput.classList.add('border-danger');

                        // afficher un message d'erreur
                        for (let [key, errorMessage] of Object.entries(errorsList)) {
                            if (checkInput.name == key) {
                                errorField.innerHTML = errorMessage;
                            }
                        }
                    }else{
                        // retirer la bordure
                        checkInput.classList.remove('border-danger');
                    }
                }
            });
        });
    }
}

export { submitForm, validateForm };