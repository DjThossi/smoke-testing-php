<?php
namespace DjThossi\SmokeTestingPhp\ValueObject\Ensure;

use Exception;

class InvalidValueException extends Exception
{
    const USERNAME_IS_NOT_A_STRING = 1;
    const USERNAME_IS_NOT_EMPTY = 2;
    const PASSWORD_IS_NOT_A_STRING = 3;
}
