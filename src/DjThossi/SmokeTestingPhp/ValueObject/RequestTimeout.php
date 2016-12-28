<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsIntegerTrait;
use DjThossi\SmokeTestingPhp\Ensure\InvalidValueException;

class RequestTimeout
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;

    const IN_SECONDS_IS_TOO_SMALL = 2;

    /**
     * @var int
     */
    private $inSeconds;

    /**
     * @param int $inSeconds
     */
    public function __construct($inSeconds)
    {
        $this->ensureInSeconds($inSeconds);

        $this->inSeconds = $inSeconds;
    }

    /**
     * @return int
     */
    public function inSeconds()
    {
        return $this->inSeconds;
    }

    /**
     * @param mixed $inSeconds
     */
    private function ensureInSeconds($inSeconds)
    {
        $this->ensureIsInteger(
            'InSeconds',
            InvalidValueException::IN_SECONDS_IS_NOT_AN_INTEGER,
            $inSeconds
        );

        $this->ensureIsGreaterThan(
            'InSeconds',
            -1,
            $inSeconds,
            self::IN_SECONDS_IS_TOO_SMALL
        );
    }
}
