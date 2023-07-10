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
        var_dump($_POST);

        $form = new Form();

        $form->startForm('#', 'post', ['class' => 'text-center', 'id' => 'registerForm'])
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('username', 'Username')
            ->addInput('text', 'username', ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'AwesomeName', 'aria-placeholder' => 'AwesomeName', 'required' => true, 'maxlength' => '12'])
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('email', 'Email address')
            ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com','aria-placeholder' => 'name@example.com', 'required' => true])
            ->addTagEnd('div')
            ->addTagStart('div', '', ['class' => 'py-2'])
            ->addLabelFor('passw', 'Password')
            ->addInput('password', 'password', ['id' => 'passw', 'class' => 'form-control', 'placeholder' => 'Password', 'aria-placeholder' => 'Password', 'required' => true])
            ->addTagEnd('div')
            ->addTagStart('p', 'By clicking Accept and Register, you agree to the <a href="/main/legal" >Terms of Use and Privacy Policy</a> of LSSProject (Motus)', ['class' => 'small py-1'])
            ->addTagEnd('p')
            ->addButton('Accept and Register', ['type' => 'submit', 'class' => 'btn btn-success w-100 py-2 mt-1'])
            ->addTagStart('p', 'Already registered? <a href="/login">Sign in</a>', ['class' => 'small py-1'])
            ->addTagEnd('p')
            ->endForm();



        // TODO: add maxlength and pattern + disabled (on button) attributes

        // définir le titre de la page HTML
        $title = "LSSProject - Register";

        $this->render('/register', ['title' => $title, 'registerForm' => $form->createForm()], 'home_template');
    }
}