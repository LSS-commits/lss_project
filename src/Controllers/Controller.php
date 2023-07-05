<?php
namespace LSSProject\Src\Controllers;

/**
 * Controller principal qui contient les méthodes génériques
 */
abstract class Controller 
{
    public function render(string $file, array $data = [])
    {
        // extraire le contenu de $data
        extract($data);
        
        // créer le chemin vers la vue pour lui transmettre les données
        require_once ROOT.'/Views/' . $file . '.php';
    }
}