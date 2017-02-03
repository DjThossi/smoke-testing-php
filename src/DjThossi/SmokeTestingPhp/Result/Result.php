<?php
namespace DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\Collection\HeaderCollection;
use DjThossi\SmokeTestingPhp\ValueObject\Body;
use DjThossi\SmokeTestingPhp\ValueObject\StatusCode;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use DjThossi\SmokeTestingPhp\ValueObject\Url;

interface Result
{
    /**
     * @return string
     */
    public function asString();

    /**
     * @return Body
     */
    public function getBody();

    /**
     * @return HeaderCollection
     */
    public function getHeaders();

    /**
     * @return StatusCode
     */
    public function getStatusCode();

    /**
     * @return TimeToFirstByte
     */
    public function getTimeToFirstByte();

    /**
     * @return Url
     */
    public function getUrl();

    /**
     * @return bool
     */
    public function isValidResult();
}
