<?php

use LSSProject\Autoloader;
use LSSProject\Src\Models\Game\Word;
use LSSProject\Src\Models\Users\User;

// pour charger les fichiers des classes automatiquement (Autoloader)
require_once dirname(__DIR__).'/Autoloader.php';
Autoloader::registerAutoloader();


$user1 = new User("Tybalt", "qsdqsdq@gmail.com", "ffqqdsq");
var_dump($user1);

// $model = new Word();
// $word1 = $model
//     ->setWord('word')
//     ->setLength()
//     ->setDifficulty();

// $model->create($word1);
// var_dump($word1);

$model = new Word();

// // écrire null pour les champs dont les setters ne prennent pas de paramètres
// $data = [
//     'word' => "tapestry",
//     'length' => null,
//     'difficulty' => null
// ];

// $word2 = $model->hydrate($data);

// $model->create($word2);
// var_dump($word2);

// $model = new Word();
// $data = [
//     'word' => 'chocolate',
//     'length' => null,
//     'difficulty' => null
// ];

// $word = $model->hydrate($data);
// // mettre à jour le 2e enregistrement de la table
// $model->update(2, $word);
// var_dump($word);


// $model = new Word();
// $word3 = $model->find(3);
// // supprimer l'enregistrement de la table
// affiche la requête ou le message 'Entry was not found'
// var_dump($model->delete(3));

