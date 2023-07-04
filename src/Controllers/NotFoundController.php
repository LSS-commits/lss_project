<?php

namespace LSSProject\Src\Controllers;

// TODO: à revoir
class NotFoundController extends Controller
{
    public function pageNotFound()
    {
        $this->render('notfound/pageNotFound', [], '404');
    }
}