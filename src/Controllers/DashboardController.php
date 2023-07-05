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
        
        // on va chercher l'utilisateur connecté
        $user = $userModel->find($userId);
        
        $wordModel = new Word();
        $words = $wordModel->findAll();

        // pour afficher les données dans la vue correspondante => render('/dir/file', ['variable' => données]) ou render('/dir/file', compact('variable'))
        $this->render('user/dashboard', compact('user', 'words'));
    }
}