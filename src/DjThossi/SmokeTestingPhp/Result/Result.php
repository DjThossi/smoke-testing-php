<?php
namespace DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\ValueObject\Body;
use DjThossi\SmokeTestingPhp\ValueObject\StatusCode;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use DjThossi\SmokeTestingPhp\ValueObject\Url;

interface Result
{
    /**
     * @return Url
     */
    public function getUrl();

    /**
     * @return string
     */
    public function asString();

    /**
     * @return TimeToFirstByte
     */
    public function getTimeToFirstByte();

    /**
     * @return Body
     */
    public function getBody();

    /**
     * @return StatusCode
     */
    public function getStatusCode();

    /**
     * @return bool
     */
    public function isValidResult();
}
