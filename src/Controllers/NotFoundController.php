<?php

namespace LSSProject\Src\Controllers;

class NotFoundController extends Controller
{
    /**
     * Cette méthode affichera une page 404
     * (notfound)
     * @return void
     */
    public function index()
    {
        
        // pour envoyer des données à la vue
        // définir le titre de la page HTML
        $title = "LSSProject - Page not found";
        // définir le contenu
        $content = ["404", "Uh oh...", "It could be you, or it could be us, but there's no page here!"];
        // envoyer les données au template
        $this->render('/notfound', compact('title', 'content'));
    }
}