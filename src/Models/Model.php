<?php
namespace LSSProject\Src\Models;

use LSSProject\Core\Db;


/**
 * Modèle pour le CRUD, interaction avec la BDD
 */
class Model extends Db
{
    // table de la bdd
    protected $table;
    // instance de Db;
    private $db;

    // READ 
    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll()
    {
        $query = $this->model_query('SELECT * FROM '. $this->table);
        return $query->fetchAll();
    }

    /**
     * Sélection de plusieurs enregistrements suivant un tableau de critères (filtrer les données)
     * @param array $filters Tableau de critères
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $filters)
    {
        $fields = [];
        $values = [];

        // boucler pour éclater les données récupérées et créer un tableau assoc
        foreach($filters as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        // transformer le tableau fields en une string pour concaténer les champs
        $fields_str = implode(' AND ', $fields);
        
        // exécuter la requête
        return $this->model_query('SELECT * FROM '.$this->table.' WHERE '. $fields_str, $values)->fetchAll();
    }

    /**
     * Sélection d'un enregistrement suivant son id
     * @param int $id id de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function find(int $id)
    {
        return $this->model_query("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }


    // CREATE













    /**
     * Méthode pour vérifier si la requête doit être préparée (contre injections sql) ou non
     * et exécuter les requêtes
     * @param string $sql requête SQL à exécuter
     * @param array|null $attributes attributs à ajouter à la requête
     * @return PDOStatement|False
     */
    public function model_query(string $sql, array $attributes = null)
    {
        // récupérer l'instance de Db
        $this->db = Db::getInstance();

        // vérifier si on a des attributs
        if($attributes !== null){
            // requête préparée
            $query = $this->db->prepare($sql);
            // bind tous les potentiels attributs et exécuter
            $query->execute($attributes);
            return $query;
        }else{
            // requête simple (fetch par ex)
            return $this->db->query($sql);
        }
    }
}