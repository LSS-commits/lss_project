<?php
namespace LSSProject\Core;

use LSSProject\Src\Controllers\MainController;

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
        if (!empty($uri) && $uri != "/" && $uri[-1] === "/"){
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
        // vérifier si des paramètres sont passés (p existe)
        if(isset($_GET['p'])){
            $params = explode('/', $_GET['p']);
        }

        // vérifier si il y a au moins 1 paramètre
        if($params[0] != ''){
            // nom du controller à instancier
            $controller = '\\LSSProject\\Src\\Controllers\\'.ucfirst(array_shift($params)).'Controller';
            
            // vérifier si le controller existe
            if (class_exists($controller)) {
                // instancier le controller
                $controller = new $controller;
            }else{
                // le controller n'existe pas, 404
                http_response_code(404);
                header('Location: /notfound');
            }

            // récupérer un éventuel deuxième paramètre = action (méthode)
            // sinon passer méthode index() cad page d'accueil
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if(method_exists($controller, $action)){
                // si il reste des params, on les passe à la méthode
                (isset($params[0])) ? $controller->$action($params) : $controller->$action();
            }
            else{
                // la méthode n'existe pas dans le controller, 404
                http_response_code(404);
                header('Location: /notfound');
            }  

        }else{
            // si pas de paramètre dans l'URL, instancier le controller par défaut (page d'accueil)
            $controller = new MainController;

            // appeler la méthode index() de MainController
            $controller->index();
        }
    }
}