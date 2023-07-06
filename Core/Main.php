<?php
namespace LSSProject\Core;

use LSSProject\Src\Controllers\MainController;
use LSSProject\Src\Controllers\NotFoundController;
use ReflectionMethod;

/**
 * Routeur principal
 * va chercher et lire les URLs (couplé avec public/index.php) et appelle les controllers correspondants
 */
class Main 
{
    // démarrer l'application
    public function start()
    {
        // retirer un éventuel trailing slash de l'url (pour éviter le duplicate content)
        // récupérer l'url
        $uri = $_SERVER['REQUEST_URI'];
        // vérifier que $uri n'est pas vide et se termine par un /
        if (!empty($uri) && $uri[-1] === "/" && $uri != "/"){
            // retirer le dernier slash
            $uri = substr($uri, 0, -1);

            // envoyer le code de redirection d'URL permanente 301
            http_response_code(301);

            // rediriger vers l'URL sans le /
            header('Location: '.$uri);
        }
        
        // gérer les paramètres d'URL

        // récupérer les params sous forme de tableau
        $params = [];

        // vérifier si des paramètres sont passés (p=controller/method/params)
        if(isset($_GET['p'])){
            // séparer les params dans un tableau
            $params = explode('/', $_GET['p']);
        }

        // vérifier si il y a au moins 1 paramètre
        if($params[0] != ''){
            // nom du controller à instancier
            $controller = '\\LSSProject\\Src\\Controllers\\'.ucfirst(array_shift($params)).'Controller';
            
            
            // instancier le controller
            $controller = new $controller;

            // récupérer un éventuel deuxième paramètre = action (méthode)
            // sinon passer méthode index() cad page d'accueil
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            // vérifier si la méthode existe
            if(method_exists($controller, $action)){

                // vérifier si la méthode prend des paramètres
                $actionParams = new ReflectionMethod($controller, $action);

                if ($actionParams->getParameters() != [] && !isset($params[0])) {
                    // var_dump($actionParams->getParameters());
                    // echo "Manque des paramètres";

                    // si il manque des paramètres à la méthode, 404
                    http_response_code(404);
                    $controller = new NotFoundController();
                    $controller->index();
                } else {
                    // si il reste des params, on les passe à la méthode (1 par 1 grâce à call_user_func_array, au lieu d'un tableau)
                    (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
                }
                
            }else{
                
                // la méthode n'existe pas dans le controller, afficher la page 404
                http_response_code(404);
                // echo "This page does not exist";
                $controller = new NotFoundController();
                $controller->index();
            }  

        }else{
            // si pas de paramètre dans l'URL, instancier le controller par défaut (page d'accueil)
            $controller = new MainController;

            // appeler la méthode index() de MainController
            $controller->index();
        }
    }
}