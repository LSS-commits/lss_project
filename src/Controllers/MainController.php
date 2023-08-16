<?php

namespace LSSProject\Src\Controllers;

/**
 * Controller de la page d'accueil du site
 */
class MainController extends Controller
{
    public function index()
    {
        // ici on n'envoie pas de données et utilise le template loggedoff_template
        $this->render('/index', [], 'loggedoff_template');
    }

    public function legal()
    {
        $title = 'LSSProject - Legal';
        $this->render('main/legal', compact('title'), 'loggedoff_template');
    }
}