<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

use Exception;

class InvalidValueException extends Exception
{
    // TODO Move these constants out of ensure Level
    const USERNAME_IS_NOT_A_STRING = 1;
    const PASSWORD_IS_NOT_A_STRING = 3;
    const URL_IS_NOT_A_STRING = 11;
    const URL_IS_NOT_A_URL = 12;
}
