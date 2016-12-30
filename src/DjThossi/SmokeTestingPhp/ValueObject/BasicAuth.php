<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\EnsureIsNotEmptyTrait;
use DjThossi\Ensure\EnsureIsStringTrait;

class BasicAuth
{
    use EnsureIsStringTrait;
    use EnsureIsNotEmptyTrait;

    const USERNAME_IS_NOT_A_STRING = 1;
    const USERNAME_IS_EMPTY = 2;
    const PASSWORD_IS_NOT_A_STRING = 3;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->ensureUsername($username);
        $this->ensurePassword($password);

        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $username
     */
    private function ensureUsername($username)
    {
        $this->ensureIsString('Username', $username, self::USERNAME_IS_NOT_A_STRING);
        $this->ensureIsNotEmpty('Username', $username, self::USERNAME_IS_EMPTY);
    }

    /**
     * @param mixed $password
     */
    private function ensurePassword($password)
    {
        $this->ensureIsString('Password', $password, self::PASSWORD_IS_NOT_A_STRING);
    }
}
