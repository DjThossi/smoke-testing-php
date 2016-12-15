<?php
namespace DjThossi\SmokeTestingPhp;

class BodyLength
{
    /**
     * @var int
     */
    private $charsToPreserve;


    /**
     * @param int $charsToPreserve
     */
    public function __construct($charsToPreserve)
    {
        $this->charsToPreserve = $charsToPreserve;
    }

    /**
     * @return int
     */
    public function asInteger()
    {
        return $this->charsToPreserve;
    }
}
