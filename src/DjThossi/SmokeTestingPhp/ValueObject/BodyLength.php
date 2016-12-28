<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsIntegerTrait;
use DjThossi\SmokeTestingPhp\Ensure\InvalidValueException;

class BodyLength
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;

    const CHARS_TO_PRESERVE_IS_TOO_SMALL = 2;

    /**
     * @var int
     */
    private $charsToPreserve;

    /**
     * @param int $charsToPreserve
     */
    public function __construct($charsToPreserve)
    {
        $this->ensureCharsToPreserve($charsToPreserve);

        $this->charsToPreserve = $charsToPreserve;
    }

    /**
     * @return int
     */
    public function asInteger()
    {
        return $this->charsToPreserve;
    }

    /**
     * @param mixed $charsToPreserve
     */
    private function ensureCharsToPreserve($charsToPreserve)
    {
        $this->ensureIsInteger(
            'CharsToPreserve',
            InvalidValueException::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER,
            $charsToPreserve
        );

        $this->ensureIsGreaterThan(
            'CharsToPreserve',
            -1,
            $charsToPreserve,
            self::CHARS_TO_PRESERVE_IS_TOO_SMALL
        );
    }
}
