<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $content[0] ?></h1>
    <h2><?= $content[1] ?></h2>
    <p><?= $content[2] ?></p>
    <!-- TODO: Si l'utilisateur est connecté, dashboard, sinon accueil -->
    <a href="/" class="link link-secondary">Back to home page</a>
</body>
</html>