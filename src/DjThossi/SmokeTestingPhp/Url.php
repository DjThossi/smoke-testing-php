<?php
namespace DjThossi\SmokeTestingPhp;

class Url
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->url;
    }
}
