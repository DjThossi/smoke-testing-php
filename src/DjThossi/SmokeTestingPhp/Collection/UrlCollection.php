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
        $urlCollection = new self();
        foreach ($urls as $url) {
            $urlCollection->addUrl(new Url($url));
        }

        return $urlCollection;
    }

    /**
     * @param Url $url
     */
    public function addUrl(Url $url)
    {
        $this->addUrl($url);
    }

    /**
     * @return Url
     */
    public function current()
    {
        return current($this->getElements());
    }
}
