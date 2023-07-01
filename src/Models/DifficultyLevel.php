<?php
namespace LSSProject\Src\Models;

use ReflectionClass;

/**
 * Enumération des niveaux de difficulté pour la table words
 */
class DifficultyLevel{
    
    // niveaux de difficulté
    private const EASY = "Easy";
    private const NORMAL = "Normal";
    private const HARD = "Hard";

    // récupérer le niveau par son nom
    public static function getDifficultyLevel($value)
    {
        // retourner la valeur validée sinon null
        if(self::isValid($value) === true){
            return ucfirst(strtolower($value));
        }
    }

    // récupérer les niveaux (constantes) sous forme de tableau
    public static function toArray()
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

    // vérifier l'existence d'un niveau
    public static function isValid($value)
    {
        // mettre en minuscules et capitaliser la première lettre
        $value = ucfirst(strtolower($value));

        // retourner true si la valeur existe sinon false
        if(in_array($value, static::toArray()) === true){
            return in_array($value, static::toArray());
        }else{
            return false;
        }
    }
}