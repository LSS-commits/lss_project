<?php
// routeur qui va chercher et lire les URLs (couplé avec public/index.php)
namespace LSSProject\Core;

class Main 
{
    // démarrer l'application
    public function start()
    {
        echo "Routeur lancé";

        // http://lss-project.test/controller/method/parameters
        // http://lss-project.test/dashboard/play/game-id
    }
}