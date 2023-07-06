<?php
namespace LSSProject\Src\Controllers;

/**
 * Controller principal qui contient les méthodes génériques
 */
abstract class Controller 
{
    public function render(string $file, array $data = [])
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
        // envoyer le tout au template default.php
        require_once ROOT.'/Views/default.php';  
    }
}