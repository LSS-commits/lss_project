/* GESTION DES FORMULAIRES */
const email = document.getElementById('email');
const password = document.getElementById('passw');
const message = document.getElementById('formMessage');

// const page = document.querySelector('html');

/* INSCRIPTION */
const registerForm = document.getElementById("registerForm");
const username = document.getElementById('username');

/* CONNEXION */
const loginForm = document.getElementById("loginForm");

// messages d'erreurs (regex patterns dans le controller)
const errors = {
    'username': 'Username must be 1 to 12 characters and contain only letters and numbers',
    'email': 'Valid email example: name@example.domain',
    'password': 'Valid password must be between 8 and 50 characters, and contain at least 1 number, 1 lowercase letter, 1 uppercase letter and 1 of the following symbols: @ # - _ $ % & + = § ! ?',
}

/* VALIDATION */
if (registerForm) {
    // vérifier le formulaire lors de la saisie
    registerForm.addEventListener('input', () => {
        // pas de message si le formulaire est valide
        message.innerHTML = '';

        // tableau contenant tous les champs input du formulaire
        let checkInputs = registerForm.querySelectorAll('input');

        // si champs input sont invalides, bordure rouge et message d'erreur
        checkInputs.forEach(checkInput => {
            if (checkInput.value !== '') {
                // si le champ n'est pas valide (regex pattern dans le controller)
                if (checkInput.checkValidity() == false) {
                    // mettre une bordure rouge
                    checkInput.classList.add('border-danger');

                    // afficher un message d'erreur
                    for (let [key, errorMessage] of Object.entries(errors)) {
                        if (checkInput.name == key) {
                            message.innerHTML = errorMessage;
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



/* EMPECHER LE RECHARGEMENT DE LA PAGE ET ENVOYER LES DONNEES DU FORMULAIRE AU CONTROLLER AU FORMAT JSON */
if (registerForm) {
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





/* POSSIBILITE DE VOIR LE MOT DE PASSE */
const passwCheck = document.getElementById("passwCheck");

if (passwCheck) {
    passwCheck.addEventListener('click', () => {
        if(password.type === "password"){
            password.type = "text";
        }else if(password.type === "text"){
            password.type = "password";
        }
    })
}