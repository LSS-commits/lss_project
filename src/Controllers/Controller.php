<?php
namespace LSSProject\Src\Controllers;

/**
 * Controller principal qui contient les méthodes génériques
 */
abstract class Controller 
{
    /**
     * Vérifier si l'utilisateur est authentifié
     * sinon le rediriger vers la page de connexion
     * @return bool
     */
    public function userIsAuthenticated()
    {
        // vérifier si l'utilisateur est connecté
        if(!isset($_SESSION) || empty($_SESSION['user']['id']) || empty($_SESSION['user']['token'])){
            // utilisateur non connecté
            $_SESSION['error']['unauthorized'] = "You must be authenticated to access this page";

            // renvoyer un code 401 (unauthorized, non authentifié)
            http_response_code(401);

            // rediriger vers page de connexion
            header('Location: /login');
            exit;
        }else{
            return true;
        }
    }


    /**
     * Afficher une vue
     *
     * @param string $file
     * @param array $data
     * @param string $template
     * @return void
     */
    public function render(string $file, array $data = [], string $template = 'default_template')
    {
        // extraire le contenu de $data
        extract($data);

        // démarrer le buffer de sortie/output buffer (mettre en mémoire les données puis les stocker dans une variable à envoyer à la vue)
        ob_start();
        // à partir de ce point, toute sortie est conservée en mémoire

        // créer le chemin vers la vue correspondante pour lui transmettre les données
        require_once ROOT.'/Views/' . $file . '.php';

        // stocker le buffer dans une variable $content
        // ici le buffer contient le html de la vue et les données insérées dans les balises
        $content = ob_get_clean();

        // envoyer le tout au template (template indiqué dans le controller ou template par défaut)
        require_once ROOT.'/Views/templates/' . $template . '.php';  
    }
}