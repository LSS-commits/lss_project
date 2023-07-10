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
            // SELECT * FROM table WHERE field1 = ? AND field2 = ? etc
            // bindValue(1, value)
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        // transformer le tableau fields en une string pour concaténer les champs
        $fieldsStr = implode(' AND ', $fields);
        
        // exécuter la requête
        return $this->model_query('SELECT * FROM ' . $this->table . ' WHERE ' . $fieldsStr, $values)->fetchAll();
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
     * Insertion d'un enregistrement suivant un tableau de données
     * @return bool
     */
    public function create()
    {
        $fields = [];
        // pour insérer autant de valeurs qu'il y a de champs (paramètre fictif)
        $interrogation = [];
        $values = [];

        // boucler pour éclater le tableau
        foreach($this as $field => $value){
            // INSERT INTO table (field1, field2, etc) VALUES (?, ?, etc)
            if($value !== null && $field !== 'db' && $field !== 'table'){
                $fields[] = $field;
                $interrogation[] = "?";
                $values[] = $value;
            }
        }

        // transformer le tableau fields en une string pour concaténer les champs
        $fieldsStr = implode(', ', $fields);
        $interrogationStr = implode(', ', $interrogation);
        
        // exécuter la requête
        return $this->model_query('INSERT INTO ' . $this->table . ' (' . $fieldsStr . ') VALUES (' . $interrogationStr . ')', $values);
    }


    // UPDATE
    /**
     * Mise à jour d'un enregistrement suivant un tableau de données
     * @return bool
     */
    public function update()
    {

        
        $fields = [];
        $values = [];

        // boucler pour éclater le tableau
        foreach($this as $field => $value){
            // UPDATE table SET field1 = ?, field2 = ?, etc WHERE id = ?
            if($value !== null && $field !== 'db' && $field !== 'table'){
                $fields[] = "$field = ?";
                $values[] = $value;
            }
        }

        // TODO: Si ne fonctionne pas, remettre int $id en param
        // * @param int $id id de l'enregistrement à modifier
        $id = $this->id;
        // ajouter l'id dans les valeurs
        $values[] = $id;

        // transformer le tableau fields en une string pour concaténer les champs
        $fieldsStr = implode(', ', $fields);
        
        // exécuter la requête
        return $this->model_query('UPDATE ' . $this->table . ' SET ' . $fieldsStr . ' WHERE id = ?', $values);
    }

    // DELETE
    /**
     * Suppression d'un enregistrement
     * @param int $id id de l'enregistrement à supprimer
     * @return bool 
     */
    public function delete(int $id)
    {
        // vérifier si l'enregitrement existe
        if($this->find($id)){
            // protéger la requête = ajouter id dans le tableau des attributs de la requête à préparer
            // au lieu de la passer directement dans une requête simple
            return $this->model_query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
        }else{
            return "Entry was not found";
        }
    }

    /**
     * Méthode pour vérifier si la requête doit être préparée (contre injections sql) ou non
     * et exécuter la requête
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

    /**
     * Hydratation des données (générer automatiquement le contenu des objets)
     * @param $data Tableau associatif de données ou objet
     * @return self Retourne l'objet hydraté
     */
    public function hydrate($data)
    {
        foreach ($data as $key => $value){
            // récupérer le nom du setter correspondant à la clé (key)
            // par ex 'length' => setLength()
            $setter = 'set' . ucfirst($key);

            // vérifier si le setter existe
            if(method_exists($this, $setter)){
                // appeler le setter
                // si le setter d'un champ ne prend pas de paramètre, écrire
                // 'length' => null
                $this->$setter($value);
            }
        }
        return $this;
    }
}