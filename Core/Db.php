<?php
namespace LSSProject\Core;

// pour se connecter au serveur / BDD
// "importer" PDO
use PDO, PDOException;

// utiliser la fonction built-in parse_ini_file de PHP au lieu d'installer Composer pour les variables d'env
$env = parse_ini_file(dirname(__DIR__).'/.env');

// définir les constantes d'env pour les passer aux constantes privées de la classe
define('APP_DBHOST', $env["APP_DBHOST"]);
define('APP_DBUSER', $env["APP_DBUSER"]);
define('APP_DBPASS', $env["APP_DBPASS"]);
define('APP_DBNAME', $env["APP_DBNAME"]);

/**
 * Connexion à la base de données
 * Singleton design pattern (cette classe a une instance unique)
 */
class Db extends PDO
{
    // instance unique de la classe
    private static $instance;

    // informations de connexion à la bdd
    private const DBHOST = APP_DBHOST;
    private const DBUSER = APP_DBUSER;
    private const DBPASS = APP_DBPASS;
    private const DBNAME = APP_DBNAME;

    // constructeur privé non instanciable
    private function __construct()
    {
        // DSN (data source name) de connexion
        $_dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;
        
        // appeler le constructeur de la classe PDO
        try{
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);

            // faire toutes les transactions en utf8
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            // pour récupérer des OBJETS (objet->nom de colonne => valeur) lors des fetch
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // définir le mode de transfert d'erreur
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            // gérer les erreurs si la connexion échoue
            die($e->getMessage());
        }
    }

    // méthode statique publique pour vérifier si une instance de Db existe, si oui la retourner, sinon la créer
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}