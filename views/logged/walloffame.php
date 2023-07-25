<title><?= $title ?></title>

<div class="container walloffame">
    <h1>Wall of Fame</h1>

    <div class="walloffame-box">
        <div class="walloffame-allusers">

        </div>
        <div class="walloffame-currentuser">

        </div>
    </div>

    <!-- carte de motivation -->
    <div class="motivation bg-light rounded p-3 my-5">
        <h3>Some words of motivation for the day:</h3>
        <p class="mb-1 fst-italic" id="quote"></p>
        <span id="author"></span>
    </div>
    <!-- fin carte de motivation -->

    <!-- appel à l'action : nouvelle partie -->
    <a href="/game/user/<?= $_SESSION['user']['token'] ?>" class="btn btn-primary" role="button">New game</a>

</div>

<!-- JS -->
<script src="/js/api.js"></script>
