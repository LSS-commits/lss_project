<?php
// use LSSProject\Autoloader;
// use LSSProject\Src\Models\Game\Game;
// use LSSProject\Src\Models\Game\Word;
// use LSSProject\Src\Models\Users\User;

// // pour charger les fichiers des classes automatiquement (Autoloader)
// require_once dirname(__DIR__).'/Autoloader.php';
// Autoloader::registerAutoloader();


// // $model = new User();
// // $user2 = $model
// //     ->setUsername('test2')
// //     ->setEmail('test2@gmail.com')
// //     ->setPassword(password_hash('yuiop', PASSWORD_ARGON2I))
// //     ->setRoles('["ROLE_USER", "ROLE_ADMIN"]');

// // $model->create($user2);
// // var_dump($user2);

// // $model = new Word();
// // $word1 = $model
// //     ->setWord('word')
// //     ->setLength()
// //     ->setDifficulty();

// // $model->create($word1);
// // var_dump($word1);

// // $model = new Word();

// // // écrire null pour les champs dont les setters ne prennent pas de paramètres
// // $data = [
// //     'word' => "tapestry",
// //     'length' => null,
// //     'difficulty' => null
// // ];

// // $word2 = $model->hydrate($data);

// // $model->create($word2);
// // var_dump($word2);

// // $model = new Word();
// // $data = [
// //     'word' => 'chocolate',
// //     'length' => null,
// //     'difficulty' => null
// // ];

// // $word = $model->hydrate($data);
// // // mettre à jour le 2e enregistrement de la table
// // $model->update(2, $word);
// // var_dump($word);


// // $model = new Word();
// // $word3 = $model->find(3);
// // // supprimer l'enregistrement de la table
// // affiche la requête ou le message 'Entry was not found'
// // var_dump($model->delete(3));

// $model = new Game();
// $user = new User();
// $user = $user->find(2);
// $word = new Word();
// $word = $word->find(1);
// // NB les données récupérées en bdd sont des strings

// // score = (nombre de lettres x 3) - guesses
// // guesses atteint 5 max (6 coups autorisés)
// $data = [
//     'guesses' => 5,
//     'wordId' => intval($word['id']),
//     'userId' => intval($user['id'])
// ];

// $game1 = $model->hydrate($data);
// // au premier coup, guesses => 0 (boucle)
// $game1 = $model->setScore((intval($word['length']) * 3) - $model->getGuesses());
// var_dump($game1);
// // accéder aux mot et infos user
// var_dump($word['word'], $user['username']);