<title><?= $title ?></title>

<div class="container">
    <!-- pour les nouveaux inscrits -->
    <?php if (isset($_SESSION['registered'])): ?>
    
        <div class="alert alert-success text-center" role="alert">
        <?php echo $_SESSION['registered']; unset($_SESSION['registered']); ?>
        </div>

    <?php endif; ?>
    
    <h1>Dashboard</h1>
    <p>Welcome <?= $_SESSION['user']['username'] ?></p>
    
    <?php foreach ($words as $word): ?>
        <article>
            <h3><?= $word->word ?></h3>
            <p><?= $word->length ?></p>
            <p><?= $word->difficulty ?></p>
        </article>
    <?php endforeach; ?>
</div>
