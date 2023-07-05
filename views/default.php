<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/default_styles.css">
    <title>LSS Project - Motus</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
</head>

<body>
    <?php include_once ROOT.'/Views/includes/header.php'; ?>

    <!-- Injecter le contenu de la page correspondante -->
    <div class="container">
        <?= $content; ?>
    </div>

    <?php include_once ROOT.'/Views/includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>