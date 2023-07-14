<?php

namespace LSSProject\Src\Controllers;

use LSSProject\Core\Form;

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
        if (isset($_POST)) {
            if (Form::validateForm($_POST, ["username", "email", "password"])) {
    
                // vérifier que l'email n'existe pas en bdd
                
                // le formulaire est valide
                echo "FORM IS VALID";
            }
        }

        // créer le formulaire
        $form = new Form();
        
        $form->startForm('#', 'post', ['class' => 'text-center', 'id' => 'registerForm'])
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('username', 'Username')
            ->addInput('text', 'username', ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'AwesomeName', 'aria-placeholder' => 'AwesomeName', 'pattern' => '[a-zA-Z-0-9]{1,12}$', 'title' => 'Username must be 1 to 12 characters and contain only letters and numbers', 'required' => true])
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('email', 'Email address')
            ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com','aria-placeholder' => 'name@example.com', 'pattern' => '[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$', 'title' => 'Valid email example: name@example.domain', 'required' => true])
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

        $this->render('/register', ['title' => $title, 'registerForm' => $form->createForm()], 'home_template');
    }
}