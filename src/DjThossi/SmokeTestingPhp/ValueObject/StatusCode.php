<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsIntegerTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsLowerThanTrait;

class StatusCode
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;
    use EnsureIsLowerThanTrait;

    const STATUS_CODE_IS_NOT_AN_INTEGER = 1;
    const STATUS_CODE_IS_TOO_BIG = 2;
    const STATUS_CODE_IS_TOO_SMALL = 3;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param int $statusCode
     */
    public function __construct($statusCode)
    {
        $this->ensureStatusCode($statusCode);

        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function asInteger()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    private function ensureStatusCode($statusCode)
    {
        $this->ensureIsInteger('StatusCode', self::STATUS_CODE_IS_NOT_AN_INTEGER, $statusCode);
        $this->ensureIsLowerThan('StatusCode', self::STATUS_CODE_IS_TOO_BIG, 512, $statusCode);
        $this->ensureIsGreaterThan('StatusCode', 99, $statusCode, self::STATUS_CODE_IS_TOO_SMALL);
    }
}
