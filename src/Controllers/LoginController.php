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

        $form->startForm()
            ->addTagStart('div', ['class' => 'form-floating'])
            ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com','aria-placeholder' => 'name@example.com', 'required' => true])
            ->addLabelFor('email', 'Email address')
            ->addTagEnd('div')
            ->addTagStart('div', ['class' => 'form-floating'])
            ->addInput('password', 'password', ['id' => 'passw', 'class' => 'form-control', 'placeholder' => 'Password', 'aria-placeholder' => 'Password', 'required' => true])
            ->addLabelFor('passw', 'Password')
            ->addTagEnd('div')
            ->addButton('Sign in', ['type' => 'button', 'class' => 'btn btn-primary w-100 py-2'])
            ->endForm();


        // définir le titre de la page HTML
        $title = "LSSProject - Sign in";

        // envoyer les données au template
        $this->render('/login', ['title' => $title, 'form' => $form->create()], 'home_template');
    }
}