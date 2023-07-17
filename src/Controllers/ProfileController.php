<?php 

namespace LSSProject\Src\Controllers;

use LSSProject\Src\Models\Users\User;

class ProfileController extends Controller
{
    /**
     * Cette méthode affichera une page contenant les informations de l'utilisateur
     * (profil)
     * @param int $userId
     * @return void
     */
    public function user($userId)
    {
        // TODO: récupérer l'utilisateur qui s'est connecté et le passer en paramètre de la route
        // instancier le modèle correspondant à la table 'users'
        $userModel = new User();

        // on va chercher l'utilisateur connecté
        $user = $userModel->find($userId);

        // définir le titre de la page HTML
        $title = "LSSProject - Profile";

        // pour afficher les données dans la vue correspondante => render('/dir/file', ['variable' => données]) ou render('dir/file', compact('variable'))
        $this->render('logged/profile', compact('title', 'user'), 'default_template');
    }
}