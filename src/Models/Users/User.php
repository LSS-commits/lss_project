<?php
namespace LSSProject\Src\Models\Users;

use LSSProject\Src\Models\Model;

/**
 * Modèle pour la table users
 */
class User extends Model
{
    /**
     * username
     * @var str
     */
    private $username;
    
    /**
     * email
     * @var str
     */
    private $email;

    /**
     * password
     * @var str
     */

    private $password;

    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}