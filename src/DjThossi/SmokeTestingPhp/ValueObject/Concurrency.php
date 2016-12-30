<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\Ensure\EnsureIsIntegerTrait;

class Concurrency
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;

    const CONCURRENCY_IS_NOT_AN_INTEGER = 1;
    const CONCURRENCY_IS_TOO_SMALL = 2;

    /**
     * @var int
     */
    private $concurrency;

    /**
     * @param int $concurrency
     */
    public function __construct($concurrency)
    {
        $this->ensureConcurrency($concurrency);

        $this->concurrency = $concurrency;
    }

    /**
     * @return int
     */
    public function asInteger()
    {
        return $this->concurrency;
    }

    /**
     * @param mixed $concurrency
     */
    private function ensureConcurrency($concurrency)
    {
        $this->ensureIsInteger(
            'Concurrency',
            $concurrency,
            self::CONCURRENCY_IS_NOT_AN_INTEGER
        );

        $this->ensureIsGreaterThan(
            'Concurrency',
            0,
            $concurrency,
            self::CONCURRENCY_IS_TOO_SMALL
        );
    }
}
