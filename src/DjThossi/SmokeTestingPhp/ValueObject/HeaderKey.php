<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\EnsureIsNotEmptyTrait;
use DjThossi\Ensure\EnsureIsStringTrait;

class HeaderKey
{
    use EnsureIsStringTrait;
    use EnsureIsNotEmptyTrait;

    const KEY_IS_NOT_A_STRING = 1;
    const KEY_IS_EMPTY = 2;

    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->ensureKey($key);

        $this->key = $key;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    private function ensureKey($key)
    {
        $this->ensureIsString('Key', $key, self::KEY_IS_NOT_A_STRING);
        $this->ensureIsNotEmpty('Key', $key, self::KEY_IS_EMPTY);
    }
}
