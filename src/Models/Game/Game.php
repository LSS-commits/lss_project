<?php
namespace LSSProject\Src\Models\Game;

use LSSProject\Src\Models\Model;

/**
 * Modèle pour la table Game
 */

class Game extends Model
{
    protected $id;
    protected $guesses;
    protected $wordId;
    protected $score;
    protected $userId;
    protected $createdAt;

    public function __construct()
    {
        $this->table = 'games';
    }


    /**
     * Obtenir la valeur de id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Définir la valeur de id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Obtenir la valeur de guesses
     */
    public function getGuesses()
    {
        return $this->guesses;
    }

    /**
     * Définir la valeur de guesses
     */
    public function setGuesses($guesses): self
    {
        $this->guesses = $guesses;

        return $this;
    }

    /**
     * Obtenir la valeur de wordId
     */
    public function getWordId()
    {
        return $this->wordId;
    }

    /**
     * Définir la valeur de wordId
     */
    public function setWordId($wordId): self
    {
        $this->wordId = $wordId;

        return $this;
    }

    /**
     * Obtenir la valeur de score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Définir la valeur de score
     */
    public function setScore($score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Obtenir la valeur de userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Définir la valeur de userId
     */
    public function setUserId($userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Obtenir la valeur de createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Définir la valeur de createdAt
     */
    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}