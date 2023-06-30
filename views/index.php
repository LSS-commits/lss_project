<?php

use LSSProject\Autoloader;
use LSSProject\Src\Models\DifficultyLevel;
use LSSProject\Src\Models\Test;
use LSSProject\Src\Models\Users\User;

// pour charger les fichiers des classes automatiquement (Autoloader)
require_once dirname(__DIR__).'/Autoloader.php';
Autoloader::registerAutoloader();


$user1 = new User("Tybalt", "qsdqsdq@gmail.com", "ffqqdsq");
var_dump($user1);

$model = new Test;
var_dump($model->findAll());

$test1 = $model->findBy(['id' => 1]);
var_dump($test1);

$test2 = $model->find(2);
var_dump($test2);

var_dump(DifficultyLevel::getDifficulty('Raw'));
var_dump(DifficultyLevel::isValid('Raw'));
$enum1 = DifficultyLevel::toArray();
var_dump($enum1['EASY']);