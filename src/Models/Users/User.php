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
    protected $createdAt;

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
     * Créer la session PHP de l'utilisateur 
     * (données stockées et envoyées entre les pages)
     * @return void
     */
    public function setSession()
    {
        $_SESSION['user'] = [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'roles' => $this->roles,
            'createdAt' => $this->createdAt
        ];
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
    
    /**
     * Définir la valeur de roles (par défaut USER)
     *
     * @param string $roles
     * @return self
     */
    public function setRoles(string $roles = '["ROLE_USER"]'): self
    {
        $this->roles = $roles;

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
     * Définir la valeur de createdAt (valeur par défaut en bdd)
     */
    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}