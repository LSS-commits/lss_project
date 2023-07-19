<!-- Utilisateur connecté ? -->
<?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom header">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
          <img src="/assets/images/logo_purple_vertical.png" alt="lss project logo" width="70" height="70">
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/game/user/" class="nav-link px-2 text-black">New game</a></li>
        <li><a href="/dashboard/user/<?= $_SESSION['user']['id'] ?>" class="nav-link px-2 text-secondary">Dashboard</a></li>
        <li><a href="/profile/user/<?= $_SESSION['user']['id'] ?>" class="nav-link px-2 text-secondary">Profile</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <a href="/login/logout" class="btn btn-outline-secondary me-2" role="button"><i class="fa-solid fa-power-off"></i> Logout</a>
      </div>
    </header>
  </div>
<?php endif; ?>  