<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\EnsureIsNotEmptyTrait;
use DjThossi\Ensure\EnsureIsStringTrait;

class Header
{
    use EnsureIsStringTrait;
    use EnsureIsNotEmptyTrait;

    const KEY_IS_NOT_A_STRING = 1;
    const KEY_IS_EMPTY = 2;
    const VALUE_IS_NOT_A_STRING = 3;
    const VALUE_IS_EMPTY = 4;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $key
     * @param string $value
     */
    public function __construct($key, $value)
    {
        $this->ensureKey($key);
        $this->ensureValue($value);

        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $key
     */
    private function ensureKey($key)
    {
        $this->ensureIsString('Key', $key, self::KEY_IS_NOT_A_STRING);
        $this->ensureIsNotEmpty('Key', $key, self::KEY_IS_EMPTY);
    }

    /**
     * @param mixed $value
     */
    private function ensureValue($value)
    {
        $this->ensureIsString('Value', $value, self::VALUE_IS_NOT_A_STRING);
        $this->ensureIsNotEmpty('Value', $value, self::VALUE_IS_EMPTY);
    }
}
