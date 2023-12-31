<!-- Utilisateur connecté ? -->
<?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id']) && !empty($_SESSION['user']['token'])): ?>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom header">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
          <img src="/assets/images/logo_purple_vertical.png" alt="lss project logo" width="70" height="70">
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/game/user/<?= $_SESSION['user']['token'] ?>" class="nav-link px-2 text-secondary link-style" aria-current="page">New Game</a></li>
        <li><a href="/dashboard/user/<?= $_SESSION['user']['token'] ?>" class="nav-link px-2 text-secondary link-style">Dashboard</a></li>
        <li><a href="/walloffame/user/<?= $_SESSION['user']['token'] ?>" class="nav-link px-2 text-secondary link-style">Wall of Fame</a></li>
        <li><a href="/profile/user/<?= $_SESSION['user']['token'] ?>" class="nav-link px-2 text-secondary link-style">Profile</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <a href="/login/logout" class="btn btn-outline-dark me-2" role="button"><i class="fa-solid fa-power-off"></i> Logout</a>
      </div>
    </header>
  </div>
<?php endif; ?>  

<!-- JS -->
<script src="/js/main.js"></script>