<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsNotEmptyTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsStringTrait;
use DjThossi\SmokeTestingPhp\Ensure\InvalidValueException;

class BasicAuth
{
    use EnsureIsStringTrait;
    use EnsureIsNotEmptyTrait;

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
     *
     * @throws InvalidValueException
     */
    private function ensureUsername($username)
    {
        $this->ensureIsString('Username', InvalidValueException::USERNAME_IS_NOT_A_STRING, $username);
        $this->ensureIsNotEmpty('Username', InvalidValueException::USERNAME_IS_EMPTY, $username);
    }

    /**
     * @param mixed $password
     */
    private function ensurePassword($password)
    {
        $this->ensureIsString('Password', InvalidValueException::PASSWORD_IS_NOT_A_STRING, $password);
    }
}
