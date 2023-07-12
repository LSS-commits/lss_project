/* GESTION DES FORMULAIRES */
const email = document.getElementById('email');
const password = document.getElementById('passw');
const message = document.getElementById('formMessage');

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

        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log('registered successfully');
            }
            // TODO: gérer les erreurs en front ???
        };

        let data = JSON.stringify({"username": username.value, "email": email.value, 'password': password.value});
        console.log(data);

        request.open("POST", url, true);
        request.setRequestHeader("Content-Type","application/json");
        request.send(data);

        // réinitialiser le formulaire
        registerForm.reset();
    });
}


/* CONNEXION */
const loginForm = document.getElementById("loginForm");
