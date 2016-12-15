<?php
namespace DjThossi\SmokeTestingPhp;

class RequestTimeout
{
    /**
     * @var int
     */
    private $inSeconds;

    /**
     * @param int $inSeconds
     */
    public function __construct($inSeconds)
    {
        $this->inSeconds = $inSeconds;
    }

    /**
     * @return int
     */
    public function inSeconds()
    {
        return $this->inSeconds;
    }
}
