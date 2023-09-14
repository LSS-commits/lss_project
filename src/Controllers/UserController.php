<?php 

namespace LSSProject\Src\Controllers;

// TODO: CRUD utilisateurs
class UserController extends Controller
{
    public function index()
    {
        // vérifier si l'utilisateur est connecté
        if ($this->userIsAuthenticated() === true) {
            // TODO: code here
        }
        $data = ['data1', 'data2'];
        include_once ROOT.'/Views/logged/index.php';
    }
}