<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit\Collection;

use DjThossi\SmokeTestingPhp\Collection\HeaderCollection;
use DjThossi\SmokeTestingPhp\Collection\HeaderNotFoundException;
use DjThossi\SmokeTestingPhp\ValueObject\Header;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderValue;
use PHPUnit_Framework_MockObject_Matcher_InvokedRecorder;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Collection\HeaderNotFoundException
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

    public function testCanCreateFromArray()
    {
        $collection = HeaderCollection::fromArray(['key1' => 'value1']);

        $this->assertInstanceOf(HeaderCollection::class, $collection);
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
        $headerKeyMock = $this->getHeaderKeyMock(
            $this->once(),
            $headerKeyValue
        );

        $headerMock = $this->getHeaderMock(
            $this->once(),
            $headerKeyMock
        );

        $collection = new HeaderCollection();
        $collection->addHeader($headerMock);

        $searchKeyMock = $this->getHeaderKeyMock(
            $this->atLeastOnce(),
            $searchKeyValue
        );

        if ($headerKeyValue === $searchKeyValue) {
            $this->assertTrue($collection->headerKeyExists($searchKeyMock));

            return;
        }

        $this->assertFalse($collection->headerKeyExists($searchKeyMock));
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
        $headerKeyMock = $this->getHeaderKeyMock(
            $this->once(),
            $headerKeyValue
        );

        $headerMock = $this->getHeaderMock(
            $this->once(),
            $headerKeyMock
        );

        $collection = new HeaderCollection();
        $collection->addHeader($headerMock);

        $searchKeyMock = $this->getHeaderKeyMock(
            $this->atLeastOnce(),
            $searchKeyValue
        );

        if ($headerKeyValue === $searchKeyValue) {
            $this->assertSame($headerMock, $collection->getHeader($searchKeyMock));

            return;
        }

        $this->expectException(HeaderNotFoundException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Header with key "%s" not found',
                $searchKeyValue
            )
        );
        $collection->getHeader($searchKeyMock);
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
     * @dataProvider getHeaderExistsDataProvider
     *
     * @param string $headerKeyValue
     * @param string $headerValue
     * @param string $searchKeyValue
     * @param string $searchValue
     */
    public function testHeaderExists($headerKeyValue, $headerValue, $searchKeyValue, $searchValue)
    {
        $found = $headerKeyValue === $searchKeyValue && $headerValue === $searchValue;

        $headerKeyMock = $this->getHeaderKeyMock(
            $this->once(),
            $headerKeyValue
        );
        $headerValueMock = $this->getHeaderValueMock(
            $found ? $this->once() : $this->any(),
            $headerValue
        );
        $headerMock = $this->getHeaderMock(
            $this->once(),
            $headerKeyMock,
            $found ? $this->once() : $this->any(),
            $headerValueMock
        );

        $collection = new HeaderCollection();
        $collection->addHeader($headerMock);

        $searchKeyMock = $this->getHeaderKeyMock(
            $this->atLeastOnce(),
            $searchKeyValue
        );
        $searchValueMock = $this->getHeaderValueMock(
            $found ? $this->once() : $this->any(),
            $searchValue
        );
        $searchHeaderMock = $this->getHeaderMock(
            $this->once(),
            $searchKeyMock,
            $found ? $this->once() : $this->any(),
            $searchValueMock
        );

        if ($found) {
            $this->assertTrue($collection->headerExists($searchHeaderMock));

            return;
        }

        $this->assertFalse($collection->headerExists($searchHeaderMock));
    }

    /**
     * @return array
     */
    public function getHeaderExistsDataProvider()
    {
        return [
            'Finding entry' => ['HeaderKey', 'HeaderValue', 'HeaderKey', 'HeadValue'],
            'HeaderKey not found' => ['HeaderKey', 'HeaderValue', 'WrongHeaderKey', 'HeadValue'],
            'HeaderValue not found' => ['HeaderKey', 'HeaderValue', 'HeaderKey', 'WrongHeadValue'],
        ];
    }

    /**
     * @param PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expectsKey
     * @param HeaderKey $headerKey
     * @param PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expectsValue
     * @param HeaderValue $headerValue
     *
     * @return Header|PHPUnit_Framework_MockObject_MockObject
     */
    private function getHeaderMock(
        PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expectsKey = null,
        HeaderKey $headerKey = null,
        PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expectsValue = null,
        HeaderValue $headerValue = null
    ) {
        $headerMock = $this->createMock(Header::class);

        if ($expectsKey !== null) {
            $headerMock->expects($expectsKey)
                ->method('getKey')
                ->willReturn($headerKey);
        }

        if ($expectsValue !== null) {
            $headerMock->expects($expectsValue)
                ->method('getValue')
                ->willReturn($headerValue);
        }

        return $headerMock;
    }

    /**
     * @param PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expects
     * @param string $willReturn
     *
     * @return HeaderKey|PHPUnit_Framework_MockObject_MockObject
     */
    private function getHeaderKeyMock(PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expects, $willReturn)
    {
        $headerKeyMock = $this->createMock(HeaderKey::class);
        $headerKeyMock->expects($expects)
            ->method('asString')
            ->willReturn($willReturn);

        return $headerKeyMock;
    }

    /**
     * @param PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expects
     * @param string $willReturn
     *
     * @return HeaderValue|PHPUnit_Framework_MockObject_MockObject
     */
    private function getHeaderValueMock(PHPUnit_Framework_MockObject_Matcher_InvokedRecorder $expects, $willReturn)
    {
        $headerValueMock = $this->createMock(HeaderValue::class);
        $headerValueMock->expects($expects)
            ->method('asString')
            ->willReturn($willReturn);

        return $headerValueMock;
    }
}
