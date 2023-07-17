<?php

namespace LSSProject\Src\Controllers;

use LSSProject\Core\Form;
use LSSProject\Src\Models\Users\User;

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

        // récupérer les données du formulaire (fichier js)
        $_POST = json_decode(file_get_contents('php://input'), true);

        // valider le formulaire si $_POST contient des données
        if (isset($_POST) && !empty($_POST)) {


            // valider les données du formulaire
            if (Form::validateForm($_POST, ["email", "password"])) {
                // le formulaire est complet

                // nettoyer l'email
                $email = Form::testInput($_POST["email"]);
                $email = strip_tags($email);

                
                // chercher l'email entré en bdd
                $usersModel = new User;
                $userArray = $usersModel->findOneByEmail($email);

                // si l'utilisateur n'existe pas
                if (!$userArray) {
                    // renvoyer un code 400
                    http_response_code(400);

                    echo "Incorrect email and/or password";
                    exit;
                }


                // l'utilisateur existe
                // hydrater l'objet (récup données de l'utilisateur)
                // pour ignorer erreur extension intelephense (héritage non géré correctement)
                /** @var LSSProject\Src\Models\Users\User $user **/
                $user = $usersModel->hydrate($userArray);

                // vérifier si le mot de passe est correct
                if(password_verify($_POST["password"], $user->getPassword())){
                    // le mot de passe est correct
                    // créer la session
                    $user->setSession();

                    // rediriger vers le dashboard (voir fichier js)
                    header('Location: /dashboard/user/' . $user->getId());
                    exit;

                }else{
                    // renvoyer un code 400
                    http_response_code(400);

                    echo "Incorrect email and/or password";
                    exit;
                }
            }
        }
       

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

    /**
     * Déconnecter l'utilisateur
     *
     * @return exit
     */
    public function logout(){

        // détruit la variable user (données de l'utilisateur) dans la session
        unset($_SESSION['user']);

        // supprime le cookie de session lié à la session mais un nouveau cookie est créé lors de la rediction sur la page d'accueil
        // setcookie(session_name(), "", time()-3600, '/');

        // retourner sur la page d'accueil 
        header('Location: /');

        // ou rester sur la page actuelle
        // header('Location: '. $_SERVER['HTTP_REFERER']);

        exit;
    }
}