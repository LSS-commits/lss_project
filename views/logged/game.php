<div class="container game">
    <h1>Game page</h1>

    <!-- avant démarrage du jeu, formulaire pour choisir le niveau => selon la difficulté, aller récupérer un mot correspondant en base de données -->
    <!-- Bouton de lancement de la modale -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#levelModal">
        Pick a Level
    </button>

    <!-- Modale -->
    <div class="modal fade" id="levelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="levelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="levelModalLabel">Pick Game Level</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- TODO: formulaire de choix du niveau => select -->
                    <button type="button" class="btn btn-success">Easy</button>
                    <button type="button" class="btn btn-warning">Normal</button>
                    <button type="button" class="btn btn-danger">Hard</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Play</button>
                </div>
            </div>
        </div>
    </div>


    <div class="game-box"></div>

    <div class="game-messages"></div>

    <div class="game-wof"></div>

</div>