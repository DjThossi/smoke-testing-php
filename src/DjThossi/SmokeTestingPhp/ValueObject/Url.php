<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\EnsureIsStringTrait;
use DjThossi\SmokeTestingPhp\Ensure\EnsureIsUrlTrait;
use DjThossi\SmokeTestingPhp\Ensure\InvalidValueException;

class Url
{
    use EnsureIsStringTrait;
    use EnsureIsUrlTrait;

    const URL_IS_NOT_A_STRING = 1;
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
        $this->ensureIsString('Url', $url, self::URL_IS_NOT_A_STRING);
        $this->ensureIsUrl('Url', InvalidValueException::URL_IS_NOT_A_URL, $url);
    }
}
