<?php

namespace LSSProject\Src\Controllers;

class GameController extends Controller 
{
    /**
     * Lancer et enregistrer une partie
     *
     * @return void
     */
    public function user()
    {
        // vérifier si l'utilisateur est connecté
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            // l'utilisateur est connecté
        }else{
            // utilisateur non connecté
            $_SESSION['error']['unauthorized'] = "You must be authenticated to access this page";

            // renvoyer un code 401 (unauthorized, non authentifié)
            http_response_code(401);

            // rediriger vers page de connexion
            header('Location: /login');
            exit;
        }

        // TODO: mettre en paramètre le token de session ?

        $title = "LSSProject - Playing";

        $this->render('logged/game', compact('title'), ('default_template'));
    }
}
