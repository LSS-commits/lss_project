/* GESTION DES FORMULAIRES */
const email = document.getElementById('email');
const password = document.getElementById('passw');
const message = document.getElementById('formMessage');

// const page = document.querySelector('html');

/* INSCRIPTION */
const registerForm = document.getElementById("registerForm");
const username = document.getElementById('username');

/* EMPECHER LE RECHARGEMENT DE LA PAGE ET ENVOYER LES DONNEES DU FORMULAIRE AU CONTROLLER AU FORMAT JSON */
if (registerForm != undefined) {
    registerForm.addEventListener('submit', function (event){
    
        // empêcher le rechargement de la page lorsque le formulaire est envoyé
        event.preventDefault();
        
        let request = new XMLHttpRequest();
        // url du fichier qui traitera les données du formulaire
        let url = "register";

        // définir une fonction à exécuter lorsque le readyState (statut de la requête) change
        request.onreadystatechange = function() {
            // succès de la requête
            if (this.readyState === 4 && this.status === 200) {
                // remplacer le contenu de la page par la réponse
                // page.innerHTML = this.responseText;

                // ou n'afficher que les messages reçus du controller (avant le rendu du contenu HTML)
                let resp = this.responseText.split('<!DOCTYPE html>');
                message.innerHTML = resp[0];
                // console.log('registered successfully');
            }
        };

        // convertir les données du formulaire en objet JSON
        let data = JSON.stringify({"username": username.value, "email": email.value, 'password': password.value});
        // TODO: pb => les données envoyées sont accessibles dans le navigateur (requête)
        // console.log(data);

        // envoyer les données dans la requête au format JSON
        request.open("POST", url, true);
        request.setRequestHeader("Content-Type","application/json");
        request.send(data);
    });
}


/* CONNEXION */
const loginForm = document.getElementById("loginForm");




// TODO: ajouter la possibilité de voir le mot de passe