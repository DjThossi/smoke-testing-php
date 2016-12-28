<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

use Exception;

class InvalidValueException extends Exception
{
    // TODO Move these constants out of ensure Level
    const USERNAME_IS_NOT_A_STRING = 1;
    const USERNAME_IS_EMPTY = 2;
    const PASSWORD_IS_NOT_A_STRING = 3;
    const CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER = 4;
    const IN_SECONDS_IS_NOT_AN_INTEGER = 6;
    const CONCURRENCY_IS_NOT_AN_INTEGER = 8;
    const URL_IS_NOT_A_STRING = 11;
    const URL_IS_NOT_A_URL = 12;
}
