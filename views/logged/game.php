<div class="container game">
    <h1>Game page</h1>

    <!-- avant démarrage du jeu, formulaire pour choisir le niveau => selon la difficulté, aller récupérer un mot correspondant en base de données -->
    <div class="dropdown game-level-form">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Pick game level
        </button>
        <!-- TODO: à mettre dans le controller -->
        <!-- Formulaire -->
        <!-- <form class="dropdown-menu p-4" id="levelForm"> -->
            <div class="mb-3">
                <h6 class="dropdown-header p-0">Pick a level and click on Start</h6>
            </div>
            <div class="mb-3 form-check">
                <input type="radio" id="easy" name="level" value="Easy" autocomplete="off" class="form-check-input easy" checked>
                <label for="easy" class="form-check-label">Easy</label>
            </div>
            <div class="mb-3 form-check">
                <input type="radio" id="normal" name="level" value="Normal" autocomplete="off" class="form-check-input normal">
                <label for="normal" class="form-check-label">Normal</label>
            </div>
            <div class="mb-3 form-check">
                <input type="radio" id="hard" name="level" value="Hard" autocomplete="off" class="form-check-input hard">
                <label for="hard" class="form-check-label">Hard</label>
            </div>
            <button type="submit" class="btn btn-primary">Start</button>
        <!-- </form> -->
    </div>

    <div class="game-box"></div>

    <div class="game-messages"></div>

    <div class="game-wof"></div>

</div>