<?php
namespace MotusProjectLSS\Users;

/**
 * Objet User
 */
class User 
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