<?php

namespace LSSProject\Src\Controllers;

// TODO: à revoir
class NotFoundController extends Controller
{
    public function index()
    {
        // sans envoyer de données
        // include_once ROOT.'/Views/notfound.php';

        // pour envoyer des données à la vue
        // définir le titre de la page HTML
        $title = "LSSProject - Page not found";
        // définir le contenu
        $content = ["404", "Uh oh...", "It could be you, or it could be us, but there's no page here!"];
        // envoyer le tout dans le home_template
        $this->render('/notfound', compact('title', 'content'), 'home_template');
    }
}