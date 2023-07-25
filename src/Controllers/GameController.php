<?php

namespace LSSProject\Src\Controllers;

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
        }


        // TODO: avant démarrage du jeu, formulaire pour choisir le niveau, pas de rechargement de la page => selon la difficulté, aller récupérer un mot correspondant en base de données et commencer le jeu

        $title = "LSSProject - Playing";

        $this->render('logged/game', compact('title'), ('default_template'));
    }
}
