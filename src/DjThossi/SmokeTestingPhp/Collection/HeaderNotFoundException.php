<?php
namespace DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;
use Exception;

class HeaderNotFoundException extends Exception
{
    /**
     * @param HeaderKey $key
     */
    public function __construct(HeaderKey $key)
    {
        $this->message = sprintf(
            'Header with key "%s" not found',
            $key->asString()
        );
    }
}
