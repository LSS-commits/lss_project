<h1>Dashboard</h1>
<p>Welcome back <?= $user->username?></p>

<?php foreach ($words as $word): ?>
    <article>
        <h3><?= $word->word ?></h3>
        <p><?= $word->length ?></p>
        <p><?= $word->difficulty ?></p>
    </article>
<?php endforeach; ?>