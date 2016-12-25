<?php
namespace DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\ValueObject\Body;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use DjThossi\SmokeTestingPhp\ValueObject\Url;

interface Result
{
    /**
     * @return Url
     */
    public function getUrl();

    /**
     * TODO find better name.
     *
     * @return string
     */
    public function asFailureMessage();

    /**
     * @return TimeToFirstByte
     */
    public function getTimeToFirstByte();

    /**
     * @return Body
     */
    public function getBody();

    /**
     * @return bool
     */
    public function isValidResult();
}
