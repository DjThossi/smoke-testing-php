<?php
namespace DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\ValueObject\Url;

class UrlCollection extends BaseCollection
{
    /**
     * @param string $fileName
     *
     * @return UrlCollection
     */
    public static function fromFile($fileName)
    {
        $urls = file($fileName);
        $urls = array_map('trim', $urls);

        return self::fromStrings($urls);
    }

    /**
     * @param Url[] $urls
     *
     * @return UrlCollection
     */
    public static function fromUrls(array $urls)
    {
        $urlCollection = new self();
        foreach ($urls as $url) {
            $urlCollection->addUrl($url);
        }

        return $urlCollection;
    }

    /**
     * @param string[] $urls
     *
     * @return UrlCollection
     */
    public static function fromStrings(array $urls)
    {
        foreach ($urls as &$url) {
            $url = new Url($url);
        }

        return self::fromUrls($urls);
    }

    /**
     * @param Url $url
     */
    public function addUrl(Url $url)
    {
        $this->elements[] = $url;
    }
}
