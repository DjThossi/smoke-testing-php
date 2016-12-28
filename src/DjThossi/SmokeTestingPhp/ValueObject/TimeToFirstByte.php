<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsIntegerTrait;

class TimeToFirstByte
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;

    const IN_MILLISECONDS_IS_NOT_AN_INTEGER = 1;
    const IN_MILLISECONDS_IS_TOO_SMALL = 2;

    /**
     * @var int
     */
    private $inMilliseconds;

    /**
     * @param int $inMilliseconds
     */
    public function __construct($inMilliseconds)
    {
        $this->ensureInMilliseconds($inMilliseconds);

        $this->inMilliseconds = $inMilliseconds;
    }

    /**
     * @return int
     */
    public function inMilliSeconds()
    {
        return $this->inMilliseconds;
    }

    /**
     * @param mixed $inMilliseconds
     */
    private function ensureInMilliseconds($inMilliseconds)
    {
        $this->ensureIsInteger('InMilliseconds', $inMilliseconds, self::IN_MILLISECONDS_IS_NOT_AN_INTEGER);
        $this->ensureIsGreaterThan('InMilliseconds', 0, $inMilliseconds, self::IN_MILLISECONDS_IS_TOO_SMALL);
    }
}
