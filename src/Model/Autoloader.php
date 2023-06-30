<?php
// détection automatique des instanciations de classes (pour charger les fichiers des classes sans require)

namespace MotusProjectLSS;

class Autoloader
{
    // méthode statique pour appeler une fonction sans instancier un nouvel objet de la classe
    static function registerAutoloader()
    {
        // charger la classe
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    // si la classe n'est pas connue (impossible de charger le fichier)
    static function autoload($class)
    {
        // $class = totalité du namespace de la classe concernée

        // gestion des anti-slashes pour compatibilité avec tous les OS
        // retirer le namespace de la classe et l'anti-slash (remplacer par une chaîne vide)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        // remplacer \ par / 
        $class = str_replace('\\', '/', $class);

        // recréer le chemin d'accès du fichier (dossier contenant l'autoloader + namespace + classe + extension du fichier)
        $file = __DIR__ . '/' . $class . '.php';

        // vérifier si le fichier existe
        if(file_exists($file)){
            // charger le fichier correspondant
            require_once $file;
        } 
    }
}