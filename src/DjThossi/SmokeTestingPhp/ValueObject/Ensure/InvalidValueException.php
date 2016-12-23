<?php
namespace DjThossi\SmokeTestingPhp\ValueObject\Ensure;

use Exception;

class InvalidValueException extends Exception
{
    // TODO Move these constants out of ensure Level
    const USERNAME_IS_NOT_A_STRING = 1;
    const USERNAME_IS_EMPTY = 2;
    const PASSWORD_IS_NOT_A_STRING = 3;
    const CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER = 4;
    const CHARS_TO_PRESERVE_IS_TOO_SMALL = 5;
    const IN_SECONDS_IS_NOT_AN_INTEGER = 6;
    const IN_SECONDS_IS_TOO_SMALL = 7;
    const CONCURRENCY_IS_NOT_AN_INTEGER = 8;
    const CONCURRENCY_IS_TOO_SMALL = 9;
}
