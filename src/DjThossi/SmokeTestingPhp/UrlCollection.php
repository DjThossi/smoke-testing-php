<?php
namespace DjThossi\SmokeTestingPhp;

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

        return self::fromArray($urls);
    }

    /**
     * @param array $urls
     *
     * @return UrlCollection
     */
    public static function fromArray(array $urls)
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
        $this->elements[$url->asString()] = $url;
    }

    /**
     * @return Url[]
     */
    public function asArray()
    {
        return $this->elements;
    }
}
