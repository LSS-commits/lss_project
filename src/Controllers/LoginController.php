<?php

namespace LSSProject\Src\Controllers;

/**
 * Controller de la page de connexion du site
 */
class LoginController extends Controller
{

    public function index()
    {
        $this->render('/login', [], 'home_template');
    }
}