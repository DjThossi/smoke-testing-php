<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsIntegerTrait;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;

class Concurrency
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;

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
            InvalidValueException::CONCURRENCY_IS_NOT_AN_INTEGER,
            $concurrency
        );

        $this->ensureIsGreaterThan(
            'Concurrency',
            InvalidValueException::CONCURRENCY_IS_TOO_SMALL,
            0,
            $concurrency
        );
    }
}
