<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsGreaterThanTrait;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsIntegerTrait;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;

class BodyLength
{
    use EnsureIsIntegerTrait;
    use EnsureIsGreaterThanTrait;

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
            InvalidValueException::CHARS_TO_PRESERVE_IS_TOO_SMALL,
            -1,
            $charsToPreserve
        );
    }
}
