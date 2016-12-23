<?php
namespace Unit\DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Collection\UrlCollection
 * @covers \DjThossi\SmokeTestingPhp\Collection\BaseCollection
 */
class UrlCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testIsCreatedEmpty()
    {
        $collection = new UrlCollection();

        $this->assertInstanceOf(UrlCollection::class, $collection);
        $this->assertCount(0, $collection);
    }

    public function testCanAddToCollection()
    {
        $url1 = $this->getUrlMock();
        $url2 = $this->getUrlMock();

        $collection = new UrlCollection();
        $collection->addUrl($url1);
        $collection->addUrl($url2);

        $this->assertCount(2, $collection);
    }

    public function testCanCreateFromUrls()
    {
        $urls = [
            $this->getUrlMock(),
            $this->getUrlMock(),
        ];

        $collection = UrlCollection::fromUrls($urls);

        $this->assertInstanceOf(UrlCollection::class, $collection);
        $this->assertCount(2, $collection);
    }

    public function testCanCreateFromStrings()
    {
        $urls = [
            'http://www.sebastianthoss.de',
            'http://www.sebastianthoss.de/en/',
            'http://www.sebastianthoss.de/de/',
        ];

        $collection = UrlCollection::fromStrings($urls);

        $this->assertInstanceOf(UrlCollection::class, $collection);
        $this->assertCount(3, $collection);
    }

    public function testCanCreateFromFile()
    {
        $collection = UrlCollection::fromFile(__DIR__ . '/data/workingUrls.txt');

        $this->assertInstanceOf(UrlCollection::class, $collection);
        $this->assertCount(3, $collection);
    }

    public function testCanCreateFromFileWithEmptyFile()
    {
        $collection = UrlCollection::fromFile(__DIR__ . '/data/emptyUrls.txt');

        $this->assertInstanceOf(UrlCollection::class, $collection);
        $this->assertCount(0, $collection);
    }

    public function testIteration()
    {
        $urls = [
            $this->getUrlMock(),
            $this->getUrlMock(),
        ];

        $collection = UrlCollection::fromUrls($urls);

        /** @var Url $url */
        foreach ($collection as $key => $url) {
            $this->assertSame($urls[$key], $url);
        }
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Url
     */
    private function getUrlMock()
    {
        return $this->createMock(Url::class);
    }
}
