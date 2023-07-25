<?php

namespace LSSProject\Src\Controllers;

use LSSProject\Core\Form;
use LSSProject\Src\Models\Users\User;

/**
 * Controller de la page d'inscription du site
 */
class RegisterController extends Controller
{

    /**
     * Inscription des utilisateurs 
     * Générer le formulaire et le traiter
     *
     * @return void
     */
    public function index()
    {
        // récupérer les données du formulaire (forms.js)
        $_POST = json_decode(file_get_contents('php://input'), true);
        
        // valider le formulaire si $_POST contient des données
        if (isset($_POST) && !empty($_POST)) {
            // valider les données du formulaire
            if (Form::validateForm($_POST, ["username", "email", "password"]) && Form::validateRegistration($_POST, ["username", "email", "password"])) {
                
                // nettoyer les champs => protéger contre injections SQL et failles XSS (injections de scripts malveillants dans contenu reçu par le navig)
                // strip_tags retire octets nuls, balises et entités HTML et PHP de la chaîne

                // nettoyer username
                $username = strip_tags($_POST["username"]);

                // nettoyer email 
                $email = strip_tags($_POST["email"]);

                // vérifier si l'email n'est pas déjà enregistré en bdd
                $newUser = new User;
                $userExits = $newUser->findOneByEmail($email);
                if ($userExits) {
                    // renvoyer un code 401 (non authentifié)
                    http_response_code(401);

                    // l'utilisateur existe déjà, renvoyer message d'erreur
                    echo 'User already registered with this email';
                    exit;
                }

                // chiffrer le mot de passe (ARGON2I depuis PHP 7.2)
                $pw = password_hash($_POST["password"], PASSWORD_ARGON2I);

                // hydrater l'utilisateur (roles = USER par défaut)
                $newUser->setUsername($username)
                    ->setEmail($email)
                    ->setPassword($pw)
                    ->setRoles();

                // enregistrer l'utilisateur en bdd
                $newUser->create();

                // ici id et createdAt = null
                $newUser->setSession();


                // trouver l'utilisateur créé pour récupérer son id généré en bdd
                $user = $newUser->findOneByEmail($_SESSION['user']['email']);
                $_SESSION['user']['id'] = $user->id;
                $_SESSION['user']['createdAt'] = $user->createdAt;

                // message à afficher sur la page de redirection
                $_SESSION['registered'] = "You have been successfully registered. Start a new game or navigate through website!";
                
                $token = md5(uniqid());
                $_SESSION['user']['token'] = $token;

                // rediriger vers le dashboard (voir fichier js)
                header('Location: /dashboard/user/' . $_SESSION['user']['token']);
                exit;
            }
        }

        // créer le formulaire
        $form = new Form;
        
        $form->startForm('#', 'post', ['class' => 'text-center', 'id' => 'registerForm'])
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('username', 'Username')
            ->addInput('text', 'username', ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'AwesomeName', 'aria-placeholder' => 'AwesomeName', 'pattern' => '[a-zA-Z-0-9]{1,12}$', 'title' => 'Username must be 1 to 12 characters and contain only letters without accents and numbers', 'required' => true])
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('email', 'Email address')
            ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com','aria-placeholder' => 'name@example.com', 'pattern' => '[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$', 'title' => 'Valid email example (no accent, no uppercase letter): name@example.domain', 'required' => true])
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('passw', 'Password')
            ->addInput('password', 'password', ['id' => 'passw', 'class' => 'form-control', 'placeholder' => 'Password', 'aria-placeholder' => 'Password', 'pattern' => '(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#\-_$%&+=§!\?])[0-9a-zA-Z@#\-_$%&+=§!\?]{8,50}$', 'title' => 'Valid password must be between 8 and 50 characters, and contain at least 1 number, 1 lowercase letter, 1 uppercase letter and 1 of the following symbols: @ # - _ $ % & + = § ! ?', 'required' => true])
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'd-flex text-left pb-3'])
            ->addInput('checkbox', 'passwCheck', ['id' => 'passwCheck', 'role' => 'button', 'class' => 'me-2'])
            ->addLabelFor('passwCheck', 'See password')
            ->addTagEnd('div')
            ->addTagStart('p', 'By clicking Accept and Register, you agree to the <a href="/main/legal" >Terms of Use and Privacy Policy</a> of LSSProject (Motus)', ['class' => 'small py-1'])
            ->addTagEnd('p')
            ->addTagStart('div', '', ['id' => 'formMessage', 'class' => 'text-center text-danger py-1'])
            ->addTagEnd('div')
            ->addButton('Accept and Register', ['type' => 'submit', 'class' => 'btn btn-success w-100 py-2 mt-1'])
            ->addTagStart('p', 'Already registered? <a href="/login">Sign in</a>', ['class' => 'small py-1'])
            ->addTagEnd('p')
            ->endForm();
        
        // définir le titre de la page HTML
        $title = "LSSProject - Register";

        // envoyer les données au template
        $this->render('auth/register', ['title' => $title, 'registerForm' => $form->createForm()], 'home_template');
    }
}