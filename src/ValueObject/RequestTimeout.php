<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\Ensure\EnsureIsIntegerTrait;

class RequestTimeout
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;

    const IN_SECONDS_IS_NOT_AN_INTEGER = 1;
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
            $inSeconds,
            self::IN_SECONDS_IS_NOT_AN_INTEGER
        );

        $this->ensureIsGreaterThan(
            'InSeconds',
            -1,
            $inSeconds,
            self::IN_SECONDS_IS_TOO_SMALL
        );
    }
}
