<?php

namespace LSSProject\Src\Controllers;

class GameController extends Controller 
{
    public function user()
    {
        $title = "LSSProject - Playing";

        $this->render('logged/game', compact('title'), ('default_template'));
    }
}
