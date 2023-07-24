<!-- Page de connexion -->

<title><?= $title ?></title>

<?php if (!empty($_SESSION['error']['unauthorized'])): ?>
  <div class="container alert alert-danger text-center" role="alert">
    <?php echo $_SESSION['error']['unauthorized']; unset($_SESSION['error']['unauthorized']); ?>
  </div>
<?php endif; ?>

<main class="login form-signin w-100 m-auto">
  <img class="mb-4 mx-auto d-block" src="/assets/images/logo_purple_vertical.png" alt="lss project logo" height="80">
  <h1 class="h3 mb-3 fw-normal text-center">Sign in</h1>

  <?= $loginForm ?>
 
</main>

<!-- JS -->
<script type="module" src="/js/forms.js"></script>

