<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

use Exception;

class InvalidValueException extends Exception
{
    // TODO Move these constants out of ensure Level
    const URL_IS_NOT_A_URL = 12;
}
