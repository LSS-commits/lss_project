<?php 

namespace LSSProject\Src\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $data = ['data1', 'data2'];
        include_once ROOT.'/Views/user/index.php';
    }
}