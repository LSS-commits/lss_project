<?php

namespace LSSProject\Src\Controllers;

/**
 * Controller de la page d'inscription du site
 */
class RegisterController extends Controller
{

    public function index()
    {
        // définir le titre de la page HTML
        $title = "LSSProject - Register";

        $this->render('/register', compact('title'), 'home_template');
    }
}