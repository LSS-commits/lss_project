<?php 

namespace LSSProject\Src\Controllers;

// TODO: servira plus tard pour connexion, inscription, déconnexion et CRUD utilisateurs
class UserController extends Controller
{
    public function index()
    {
        $data = ['data1', 'data2'];
        include_once ROOT.'/Views/logged/index.php';
    }
}