<?php

namespace LSSProject\Src\Controllers;

class WallOfFameController extends Controller
{
    /**
     * Cette méthode affichera une page contenant les meilleurs scores
     * (wall of fame)
     * @param string $token
     * @return void
     */
    public function user(string $token){

        // vérifier si l'utilisateur est connecté
        if ($this->userIsAuthenticated() === true) {
            // TODO: code here
        }
        
        $title = "LSSProject - Wall Of Fame";
        $this->render('logged/walloffame', compact('title'));
    }
}