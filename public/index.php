<?php
// fichier central, entrée de l'app => pour lancer le routeur, sera interrogé à chaque chargement de page

use LSSProject\Autoloader;
use LSSProject\Core\Main;

// définir une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

// importer l'autoloader pour charger automatiquement les classes
require_once ROOT.'/Autoloader.php';
Autoloader::registerAutoloader();

// instancier Main (classe qui représente le routeur) pour démarrer l'application
$app = new Main();

// démarrer l'application
$app->start();