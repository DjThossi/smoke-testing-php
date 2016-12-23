<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsStringTrait;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsUrlTrait;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;

class Url
{
    use EnsureIsStringTrait;
    use EnsureIsUrlTrait;
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->ensureUrl($url);

        $this->url = $url;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->url;
    }

    /**
     * @param $url
     */
    private function ensureUrl($url)
    {
        $this->ensureIsString('Url', InvalidValueException::URL_IS_NOT_A_STRING, $url);
        $this->ensureIsUrl('Url', InvalidValueException::URL_IS_NOT_A_URL, $url);
    }
}
