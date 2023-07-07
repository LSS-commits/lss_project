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
            ->addLabelFor('email', 'Email')
            ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'required' => true])
            ->addLabelFor('passw', 'Password')
            ->addInput('password', 'password', ['id' => 'passw', 'class' => 'form-control', 'required' => true])
            ->addSelect('level', ['Easy' => ['Easy', ['selected' => true]], 'Normal' => ['Normal', []], 'Hard' => ['Hard', []]], ['id' => 'level'])
            ->addInput('checkbox', 'acceptPolicy', ['id' => 'acceptPolicy', 'name' => 'acceptPolicy', 'value' => 1])
            ->addLabelFor('acceptPolicy', 'I accept the website\'s policy')
            ->addButton('Sign in', ['type' => 'button', 'class' => 'btn btn-primary'])
            ->endForm();


        // définir le titre de la page HTML
        $title = "LSSProject - Sign in";

        // envoyer les données au template
        $this->render('/login', ['title' => $title, 'form' => $form->create()], 'home_template');
    }
}