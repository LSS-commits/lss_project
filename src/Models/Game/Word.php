<?php
namespace LSSProject\Src\Model\Game;

use LSSProject\Src\Models\Model;

/**
 * Modèle pour la table words
 */
class Word extends Model
{
    protected $id;
    protected $word;
    protected $difficulty;
    protected $length;

    public function __construct()
    {
        $this->table = 'words';
    }
}