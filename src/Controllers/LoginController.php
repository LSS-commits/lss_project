<?php

namespace LSSProject\Src\Controllers;

use LSSProject\Core\Form;

/**
 * Controller de la page de connexion du site
 */
class LoginController extends Controller
{

    /**
     * Connexion des utilisateurs 
     * Générer le formulaire et le traiter
     *
     * @return void
     */
    public function index()
    {
        
       

        // créer le formulaire
        $form = new Form();

        $form->startForm('#', 'post', ['id' => 'loginForm'])
            ->addTagStart('div', '', ['class' => 'form-floating'])
            ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com','aria-placeholder' => 'name@example.com', 'required' => true])
            ->addLabelFor('email', 'Email address')
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'form-floating'])
            ->addInput('password', 'password', ['id' => 'passw', 'class' => 'form-control passwInput', 'placeholder' => 'Password', 'aria-placeholder' => 'Password', 'required' => true])
            ->addLabelFor('passw', 'Password')
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'd-flex text-left pb-3'])
            ->addInput('checkbox', 'passwCheck', ['id' => 'passwCheck', 'role' => 'button', 'class' => 'me-2'])
            ->addLabelFor('passwCheck', 'See password')
            ->addTagEnd('div')
            ->addTagStart('div', '', ['id' => 'formMessage', 'class' => 'text-center text-danger py-1'])
            ->addTagEnd('div')
            ->addButton('Sign in', ['type' => 'submit', 'class' => 'btn btn-primary w-100 py-2'])
            ->addTagStart('p', 'You don\'t have an account? <a href="/register">Register</a>', ['class' => 'small py-1'])
            ->addTagEnd('p')
            ->addTagStart('p', '<a href="#">Forgot your password?</a>', ['class' => 'small py-1'])
            ->addTagEnd('p')
            ->endForm();


        // définir le titre de la page HTML
        $title = "LSSProject - Sign in";

        // envoyer les données au template
        $this->render('/login', ['title' => $title, 'loginForm' => $form->createForm()], 'home_template');
    }
}