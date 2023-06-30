<?php
namespace LSSProject\Src\Models\Game;

// injection de dépendance (la classe User est passée en argment du constructeur de la classe Game)
use LSSProject\Src\Models\Users\User;

/**
 * Modèle pour la table Game
 */

class Game
{
    /**
     * Game user
     *
     * @var User
     */
    private User $user;

    /**
     * Constructeur de Game
     *
     * @param User $player joueur de la partie
     */
    public function __construct(User $player)
    {
        $this->user = $player;
    }

    /**
     * Getter de user - user qui joue la partie
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Modifie le nom du joueur et retourne l'objet
     * @param User $player joueur de la partie
     * @return Game 
     */
    public function setUser(User $player): self
    {
        if(isset($player)){
            $this->user = $player;
        }
        return $this;
    }
}