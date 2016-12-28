<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsNotEmptyTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsStringTrait;

class ErrorMessage
{
    use EnsureIsStringTrait;
    use EnsureIsNotEmptyTrait;

    const MESSAGE_IS_NOT_A_STRING = 1;
    const MESSAGE_IS_EMPTY = 2;

    /**
     * @var string
     */
    private $message;

    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $this->ensureMessage($message);

        $this->message = $message;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    private function ensureMessage($message)
    {
        $this->ensureIsString('Message', self::MESSAGE_IS_NOT_A_STRING, $message);
        $this->ensureIsNotEmpty('Message', $message, self::MESSAGE_IS_EMPTY);
    }
}
