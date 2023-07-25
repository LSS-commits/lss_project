<title><?= $title ?></title>

<div class="container dashboard">

    <!-- message de succès pour les nouveaux inscrits -->
    <?php if (isset($_SESSION['registered'])) : ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo $_SESSION['registered'];
            unset($_SESSION['registered']); ?>
        </div>
    <?php endif; ?>

    <h1>Hi <?= $_SESSION['user']['username'] ?>, welcome to your dashboard</h1>

    <!-- trivia -->
    <div class="trivia bg-light p-3 mt-5 mb-3 rounded">
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
    <!-- fin trivia -->

    <!-- appel à l'action : nouvelle partie -->
    <a href="/game/user/<?= $_SESSION['user']['token'] ?>" class="btn btn-primary my-3" role="button">New game</a>

    <!-- walloffame -->
    <div class="walloffame-sample container my-5">
        <h3 class="text-center">Wall of Fame</h3>
        <div class="walloffame-topthree my-3">
            <table class="table table-striped table-warning table-bordered caption-top">
                <caption>Top 3 of all users</caption>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Score</th>
                        <th scope="col">Difficulty</th>
                        <th scope="col">Guesses</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Tybalt13</td>
                        <td>23</td>
                        <td>Hard</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Mark</td>
                        <td>15</td>
                        <td>Normal</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Aminta</td>
                        <td>12</td>
                        <td>Normal</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 3 meilleurs scores utilisateur actuel -->
        <div class="walloffame-bestofcurrent my-3">
        <table class="table table-striped table-bordered caption-top">
                <caption>Your top 3</caption>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Word</th>
                        <th scope="col">Score</th>
                        <th scope="col">Difficulty</th>
                        <th scope="col">Guesses</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>tapestry</td>
                        <td>12</td>
                        <td>Hard</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>chocolate</td>
                        <td>11</td>
                        <td>Normal</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>word</td>
                        <td>5</td>
                        <td>Easy</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <a href="/walloffame/user/<?= $_SESSION['user']['token'] ?>" class="btn btn-primary my-3" role="button">See more</a>
    </div>
    <!-- fin walloffame -->



</div>