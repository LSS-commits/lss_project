<?php

namespace LSSProject\Src\Controllers;

/**
 * Controller de la page d'inscription du site
 */
class RegisterController extends Controller
{

    public function index()
    {
        $this->render('/register', [], 'home_template');
    }
}