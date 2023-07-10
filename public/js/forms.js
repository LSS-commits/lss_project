const registerForm = document.getElementById("registerForm");

const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('passw');
const message = document.getElementById('formMessage');

if (registerForm != undefined) {
    registerForm.addEventListener('submit', function (event){
    
        event.preventDefault();
        
        let request = new XMLHttpRequest();
        let url = "register";

        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log('registered successfully');
            }
        };

        let data = JSON.stringify({"username": username.value, "email": email.value, 'password': password.value});
        console.log(data);

        request.open("POST", url, true);
        request.setRequestHeader("Content-Type","application/json");
        request.send(data);

        registerForm.reset();
    });
}


const loginForm = document.getElementById("loginForm");
