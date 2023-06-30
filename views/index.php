<?php

use MotusProjectLSS\Autoloader;
use MotusProjectLSS\Users\User;

// pour charger les fichiers des classes automatiquement (Autoloader)
require_once 'src/Model/Autoloader.php';
Autoloader::registerAutoloader();

$user1 = new User('Tybalt', 'sdsd@gmail.com', 'tyb13');


var_dump($user1);