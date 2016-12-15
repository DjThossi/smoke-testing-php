<?php
namespace DjThossi\SmokeTestingPhp;

class Concurrency
{
    /**
     * @var int
     */
    private $concurrency;

    /**
     * @param int $concurrency
     */
    public function __construct($concurrency)
    {
        $this->concurrency = $concurrency;
    }

    /**
     * @return int
     */
    public function asInteger()
    {
        return $this->concurrency;
    }
}
