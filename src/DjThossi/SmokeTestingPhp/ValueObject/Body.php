<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsStringTrait;

class Body
{
    use EnsureIsStringTrait;

    const BODY_IS_NOT_A_STRING = 1;

    /**
     * @var string
     */
    private $body;

    /**
     * @param string $body
     */
    public function __construct($body)
    {
        $this->ensureBody($body);

        $this->body = $body;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    private function ensureBody($body)
    {
        $this->ensureIsString('Body', $body, self::BODY_IS_NOT_A_STRING);
    }
}
