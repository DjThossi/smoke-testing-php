<?php
namespace Unit\DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\Collection\HeaderCollection;
use DjThossi\SmokeTestingPhp\ValueObject\Header;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Collection\HeaderCollection
 * @covers \DjThossi\SmokeTestingPhp\Collection\BaseCollection
 */
class HeaderCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testIsCreatedEmpty()
    {
        $collection = new HeaderCollection();

        $this->assertInstanceOf(HeaderCollection::class, $collection);
        $this->assertCount(0, $collection);
    }

    public function testCanAddToCollection()
    {
        $header1 = $this->getHeaderMock();
        $header2 = $this->getHeaderMock();

        $collection = new HeaderCollection();
        $collection->addHeader($header1);
        $collection->addHeader($header2);

        $this->assertCount(2, $collection);
    }

    public function testIteration()
    {
        $headers = [
            $this->getHeaderMock(),
            $this->getHeaderMock(),
        ];

        $collection = new HeaderCollection();
        $collection->addHeader($headers[0]);
        $collection->addHeader($headers[1]);

        /** @var Header $header */
        foreach ($collection as $key => $header) {
            $this->assertSame($headers[$key], $header);
        }
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Header
     */
    private function getHeaderMock()
    {
        return $this->createMock(Header::class);
    }
}
