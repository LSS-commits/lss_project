<?php
namespace LSSProject\Src\Controllers;

/**
 * Controller principal qui contient les méthodes génériques
 */
abstract class Controller 
{
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
        require_once ROOT.'/Views/' . $template . '.php';  
    }
}