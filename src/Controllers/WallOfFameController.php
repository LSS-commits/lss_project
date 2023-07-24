<?php

namespace LSSProject\Src\Controllers;

class WallOfFameController extends Controller
{
    /**
     * Cette méthode affichera une page contenant les meilleurs scores
     * (wall of fame)
     *
     * @return void
     */
    public function user(){

        $title = "LSSProject - Wall Of Fame";
        $this->render('logged/walloffame', compact('title'), 'default_template');
    }
}