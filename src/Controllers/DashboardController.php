<?php 

namespace LSSProject\Src\Controllers;

use LSSProject\Src\Models\Game\Word;
use LSSProject\Src\Models\Users\User;

class DashboardController extends Controller
{
    /**
     * Cette méthode affichera l'espace de l'utilisateur
     * (dashboard)
     * @param int $userId
     * @return void
     */
    public function user(int $userId)
    {
        // TODO: récupérer l'utilisateur qui s'est connecté et le passer en paramètre de la route
        // instancier le modèle correspondant à la table 'users'
        $userModel = new User();
        
        // TODO: au lieu de passer id, créer un token de session et le passer
        // chercher à savoir à quel moment lors de la navigation l'utilisateur a un id valide qui puisse être utilisé pour enregitrer les jeux

        // on va chercher l'utilisateur connecté
        $user = $userModel->find($userId);
        
        $wordModel = new Word();
        $words = $wordModel->findAll();

        // récupérer un mot aléatoire en bdd pour afficher définition (trivia)
        $trivia = $wordModel->findRandom();

        // définir le titre de la page HTML
        $title = "LSSProject - Dashboard";

        // pour afficher les données dans la vue correspondante => render('/dir/file', ['variable' => données]) ou render('dir/file', compact('variable'))
        $this->render('logged/dashboard', compact('title', 'user', 'words', 'trivia'), 'default_template');
    }
}