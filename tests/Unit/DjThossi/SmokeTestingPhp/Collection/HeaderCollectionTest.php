<?php
namespace Unit\DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\Collection\HeaderCollection;
use DjThossi\SmokeTestingPhp\Collection\HeaderNotFoundException;
use DjThossi\SmokeTestingPhp\ValueObject\Header;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;
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
     * @dataProvider headerKeyExistsDataProvider
     *
     * @param string $headerKeyValue
     * @param string $searchKeyValue
     */
    public function testHeaderKeyExists($headerKeyValue, $searchKeyValue)
    {
        $headerKeyMock = $this->getHeaderKeyMock();
        $headerKeyMock->expects($this->once())
            ->method('asString')
            ->willReturn($headerKeyValue);

        $headerMock = $this->getHeaderMock();
        $headerMock->expects($this->once())
            ->method('getKey')
            ->willReturn($headerKeyMock);

        $collection = new HeaderCollection();
        $collection->addHeader($headerMock);

        $searchKeyMock = $this->getHeaderKeyMock();
        $searchKeyMock->expects($this->atLeastOnce())
            ->method('asString')
            ->willReturn($searchKeyValue);

        if ($headerKeyValue === $searchKeyValue) {
            $this->assertTrue($collection->headerKeyExists($searchKeyMock));
        } else {
            $this->assertFalse($collection->headerKeyExists($searchKeyMock));
        }
    }

    /**
     * @return array
     */
    public function headerKeyExistsDataProvider()
    {
        return [
            'Finding entry' => ['HelloWorld', 'HelloWorld'],
            'Entry not found' => ['HelloWorld', 'NotMatching'],
        ];
    }

    /**
     * @dataProvider getHeaderDataProvider
     *
     * @param string $headerKeyValue
     * @param string $searchKeyValue
     */
    public function testGetHeader($headerKeyValue, $searchKeyValue)
    {
        $headerKeyMock = $this->getHeaderKeyMock();
        $headerKeyMock->expects($this->once())
            ->method('asString')
            ->willReturn($headerKeyValue);

        $headerMock = $this->getHeaderMock();
        $headerMock->expects($this->once())
            ->method('getKey')
            ->willReturn($headerKeyMock);

        $collection = new HeaderCollection();
        $collection->addHeader($headerMock);

        $searchKeyMock = $this->getHeaderKeyMock();
        $searchKeyMock->expects($this->atLeastOnce())
            ->method('asString')
            ->willReturn($searchKeyValue);

        if ($headerKeyValue === $searchKeyValue) {
            $this->assertSame($headerMock, $collection->getHeader($searchKeyMock));
        } else {
            $this->expectException(HeaderNotFoundException::class);
            $collection->getHeader($searchKeyMock);
        }
    }

    /**
     * @return array
     */
    public function getHeaderDataProvider()
    {
        return [
            'Finding entry' => ['HelloWorld', 'HelloWorld'],
            'Entry not found' => ['HelloWorld', 'NotMatching'],
        ];
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Header
     */
    private function getHeaderMock()
    {
        return $this->createMock(Header::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|HeaderKey
     */
    private function getHeaderKeyMock()
    {
        return $this->createMock(HeaderKey::class);
    }
}
