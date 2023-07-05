<?php

namespace LSSProject\Src\Controllers;

// TODO: à revoir
class NotFoundController extends Controller
{
    public function index()
    {
        include_once ROOT.'/Views/notfound.php';

        // $this->render('notfound/pageNotFound', [], 'notfound');
    }
}