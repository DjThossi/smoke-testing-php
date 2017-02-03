<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\EnsureIsStringTrait;

class HeaderValue
{
    use EnsureIsStringTrait;

    const VALUE_IS_NOT_A_STRING = 1;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->ensureValue($value);

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    private function ensureValue($value)
    {
        $this->ensureIsString('Value', $value, self::VALUE_IS_NOT_A_STRING);
    }
}
