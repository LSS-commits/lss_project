<?php 

namespace LSSProject\Src\Controllers;


class ProfileController extends Controller
{
    /**
     * Cette méthode affichera une page contenant les informations de l'utilisateur
     * (profil)
     * @param string $token
     * @return void
     */
    public function user(string $token)
    {

        // vérifier si l'utilisateur est connecté
        if ($this->userIsAuthenticated() === true) {
            // TODO: code here
        }
        
        // définir le titre de la page HTML
        $title = "LSSProject - Profile";

        // pour afficher les données dans la vue correspondante => render('/dir/file', ['variable' => données]) ou render('dir/file', compact('variable'))
        $this->render('logged/profile', compact('title'));
    }
}