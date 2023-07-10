<?php
namespace LSSProject\Src\Models\Users;

use LSSProject\Src\Models\Model;

/**
 * Modèle pour la table users
 */
class User extends Model
{
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $roles;

    public function __construct()
    {
        $this->table = 'users';
    }

    /**
     * Récupérer un utilisateur à partir de son email
     * Méthode spécifique à ce modèle, 
     * vient surcharger les méthodes du modèle Model dont il dérive
     * @param string $email
     * @return mixed
     */
    public function findOneByEmail(string $email)
    {
        return $this->model_query("SELECT * FROM {$this->table} WHERE email = ?", [$email])->fetch();
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
     * Obtenir la valeur de username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Définir la valeur de username
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Obtenir la valeur de email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Définir la valeur de email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Obtenir la valeur de password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Définir la valeur de password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Obtenir la valeur de roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Définir la valeur de roles
     */
    public function setRoles($roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}