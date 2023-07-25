<title><?= $title ?></title>
<div class="container">
    <h1><?= $content[0] ?></h1>
    <h2><?= $content[1] ?></h2>
    <p><?= $content[2] ?></p>
    <!-- Utilisateur connecté ? si oui dashboard, sinon accueil -->
    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id']) && !empty($_SESSION['user']['token'])): ?>
        <a href="/dashboard/user/<?= $_SESSION['user']['token'] ?>"  class="link link-secondary">Back to dashboard</a>
    <?php else: ?>
        <a href="/" class="link link-secondary">Back to home page</a>
    <?php endif; ?>
</div>
