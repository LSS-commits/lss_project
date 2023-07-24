<title><?= $title ?></title>

<div class="container dashboard">
    <!-- pour les nouveaux inscrits -->
    <?php if (isset($_SESSION['registered'])): ?>
    
        <div class="alert alert-success text-center" role="alert">
        <?php echo $_SESSION['registered']; unset($_SESSION['registered']); ?>
        </div>

    <?php endif; ?>
    
    <h1>Dashboard</h1>
    <h2>Welcome <?= $_SESSION['user']['username'] ?></h2>
    <a href="/game/user/" class="btn btn-primary" role="button">New game</a>

    <?php foreach ($words as $word): ?>
        <article>
            <h3><?= $word->word ?></h3>
            <p><?= $word->length ?></p>
            <p><?= $word->difficulty ?></p>
        </article>
    <?php endforeach; ?>

    <div class="trivia bg-light p-3 rounded">
        <h3 class="text-center">Word definition of the day: <?= $trivia->word ?></h3>
        <article class="py-2">
            <p class="mb-1"><?= $trivia->trivia ?></p>
            <span class="fst-italic">Source: Cambridge Dictionary (American)</span>
        </article>

        <article class="py-2">
            <span>... And also:</span>
            <p class="mb-1"><?= $trivia->triviaJoke ?></p>
            <span class="fst-italic">Source: Urban Dictionary</span> 😁
        </article>
    </div>
</div>
