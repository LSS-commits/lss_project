/* ---------- GESTION DES FORMULAIRES ---------- */
import { validateForm, submitForm } from "./functions.js";

const email = document.getElementById('email');
const password = document.getElementById('passw');
const message = document.getElementById('formMessage');

/* INSCRIPTION */
const registerForm = document.getElementById("registerForm");
const username = document.getElementById('username');

// messages d'erreurs (regex patterns dans les balises HTML)
const errorsRegister = {
    'username': 'Username must be 1 to 12 characters and contain only letters without accents and numbers',
    'email': 'Valid email example (no accent, no uppercase letter): name@example.domain',
    'password': 'Valid password must be between 8 and 50 characters, and contain at least 1 number, 1 lowercase letter, 1 uppercase letter and 1 of the following symbols: @ # - _ $ % & + = § ! ?',
}

/* CONNEXION */
const loginForm = document.getElementById("loginForm");


// valider le formulaire d'inscription (afficher les erreurs)
validateForm(registerForm, message, errorsRegister);

// récupérer les données du formulaire sans recharger la page, les envoyer au controller, afficher les messages
submitForm(registerForm, message, "register", username, email, password);

submitForm(loginForm, message, "login", email, password);

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