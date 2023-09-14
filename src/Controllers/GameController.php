<?php

namespace LSSProject\Src\Controllers;

use LSSProject\Core\Form;

class GameController extends Controller 
{
    /**
     * Lancer et enregistrer une partie
     * @param string $token
     * @return void
     */
    public function user(string $token)
    {
        // vérifier si l'utilisateur est connecté
        if ($this->userIsAuthenticated() === true) {
            // TODO: code here
            // selon la difficulté choisie, aller récupérer un mot correspondant en base de données et commencer le jeu

            // 1) jeu terminé par une victoire, enregistrer la partie

            // 2) abandon => vider la page

            // 3) nouveau choix de niveau => vider la page et nouvel affichage avec nouveau mot
        }


        // TODO: avant démarrage du jeu, formulaire pour choisir le niveau => 
        // créer le formulaire
        $form = new Form();
        
        $form->startForm('#', 'post', ['id' => 'levelForm', 'class' => 'dropdown-menu p-4'])
        ->addTagStart('div', '', )
        ->addTagEnd('div')
        ->endForm();








        $title = "LSSProject - Playing";

        $this->render('logged/game', compact('title'));
    }
}
