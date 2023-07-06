<?php

namespace LSSProject\Src\Controllers;

/**
 * Controller de la page d'accueil du site
 */
class MainController extends Controller
{
    public function index()
    {
        // ici on n'envoie pas de données et utilise le template home_template
        $this->render('main/index', [], 'home_template');
    }
}