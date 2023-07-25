<?php 

namespace LSSProject\Src\Controllers;

use LSSProject\Src\Models\Game\Word;

class DashboardController extends Controller
{
    /**
     * Cette méthode affichera l'espace de l'utilisateur
     * (dashboard)
     * @param string $token
     * @return void
     */
    public function user(string $token)
    {
        // vérifier si l'utilisateur est connecté
        if ($this->userIsAuthenticated() === true) {
             
            $wordModel = new Word();

            // récupérer un mot aléatoire en bdd pour afficher définition (trivia)
            $trivia = $wordModel->findRandom();
        }
        

        // définir le titre de la page HTML
        $title = "LSSProject - Dashboard";

        // pour afficher les données dans la vue correspondante => render('/dir/file', ['variable' => données]) ou render('dir/file', compact('variable'))
        $this->render('logged/dashboard', compact('title', 'trivia'), 'default_template');
    }
}