<?php
namespace DjThossi\SmokeTestingPhp;

class ResponseTimeout
{
    /**
     * @var int
     */
    private $timeoutInMilliseconds;

    /**
     * @param int $timeoutInMilliseconds
     */
    public function __construct($timeoutInMilliseconds)
    {
        $this->timeoutInMilliseconds = $timeoutInMilliseconds;
    }

    /**
     * @return int
     */
    public function inMilliSeconds()
    {
        return $this->timeoutInMilliseconds;
    }
}
