<?php
namespace LSSProject\Src\Models\Game;

use LSSProject\Src\Models\Model;
use LSSProject\Src\Models\Game\DifficultyLevel;

/**
 * Modèle pour la table words
 */
class Word extends Model
{
    protected $id;
    protected $word;
    protected $length;
    protected $difficulty;
    protected $trivia;
    protected $triviaJoke;

    public function __construct()
    {
        $this->table = 'words';
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
     * Obtenir la valeur de word
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Définir la valeur de word
     */
    public function setWord($word): self
    {
        // retirer les éventuels espaces en début et fin
        $this->word = trim($word);
        return $this;
    }

    /**
     * Obtenir la valeur de length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Définir la valeur de length
     * en retournant la longueur de word
     */
    public function setLength(): self
    {
        $this->length = strlen($this->word);
        return $this;
    }

    /**
     * Obtenir la valeur de difficulty
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Définir la valeur de difficulty
     * en utilisant length et la classe DifficultyLevel ('enum')
     */
    public function setDifficulty(): self
    {
        // en fonction de la longueur du mot, récupérer le niveau correspondant 
        if($this->length === 3 || $this->length === 4){
            $this->difficulty = DifficultyLevel::getDifficultyLevel('Easy');
            return $this;
        }elseif ($this->length === 5 || $this->length === 6) {
            $this->difficulty = DifficultyLevel::getDifficultyLevel('Normal');
            return $this;
        }elseif ($this->length === 7 || $this->length === 8 || $this->length === 9) {
            $this->difficulty = DifficultyLevel::getDifficultyLevel('Hard');
            return $this;
        }
        // difficulty est null par défaut
        return $this;
    }

    /**
     * Obtenir la valeur de trivia
     */
    public function getTrivia()
    {
        return $this->trivia;
    }

    /**
     * Définir la valeur de trivia
     */
    public function setTrivia($trivia): self
    {
        $this->trivia = $trivia;

        return $this;
    }

    /**
     * Obtenir la valeur de triviaJoke
     */
    public function getTriviaJoke()
    {
        return $this->triviaJoke;
    }

    /**
     * Définir la valeur de triviaJoke
     */
    public function setTriviaJoke($triviaJoke): self
    {
        $this->triviaJoke = $triviaJoke;

        return $this;
    }
}