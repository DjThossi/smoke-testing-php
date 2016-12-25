<?php
namespace Unit\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\Result\ValidResult;
use DjThossi\SmokeTestingPhp\ValueObject\Body;
use DjThossi\SmokeTestingPhp\ValueObject\StatusCode;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Result\ValidResult
 * @covers \DjThossi\SmokeTestingPhp\Result\Result
 */
class ValidResultTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $validResult = new ValidResult(
            $this->getUrlMock(),
            $this->getBodyMock(),
            $this->getTimeToFirstByteMock(),
            $this->getStatusCodeMock()
        );
        $this->assertInstanceOf(ValidResult::class, $validResult);
    }

    public function testCanGetUrl()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getBodyMock();
        $timeToFirstByteMock = $this->getTimeToFirstByteMock();
        $statusCodeMock = $this->getStatusCodeMock();

        $validResult = new ValidResult($urlMock, $bodyMock, $timeToFirstByteMock, $statusCodeMock);
        $this->assertSame($urlMock, $validResult->getUrl());
    }

    public function testCanGetBody()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getBodyMock();
        $timeToFirstByteMock = $this->getTimeToFirstByteMock();
        $statusCodeMock = $this->getStatusCodeMock();

        $validResult = new ValidResult($urlMock, $bodyMock, $timeToFirstByteMock, $statusCodeMock);
        $this->assertSame($bodyMock, $validResult->getBody());
    }

    public function testCanGetTimeToFirstByte()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getBodyMock();
        $timeToFirstByteMock = $this->getTimeToFirstByteMock();
        $statusCodeMock = $this->getStatusCodeMock();

        $validResult = new ValidResult($urlMock, $bodyMock, $timeToFirstByteMock, $statusCodeMock);
        $this->assertSame($timeToFirstByteMock, $validResult->getTimeToFirstByte());
    }

    public function testCanGetStatusCode()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getBodyMock();
        $timeToFirstByteMock = $this->getTimeToFirstByteMock();
        $statusCodeMock = $this->getStatusCodeMock();

        $validResult = new ValidResult($urlMock, $bodyMock, $timeToFirstByteMock, $statusCodeMock);
        $this->assertSame($statusCodeMock, $validResult->getStatusCode());
    }

    public function testIsValidResult()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getBodyMock();
        $timeToFirstByteMock = $this->getTimeToFirstByteMock();
        $statusCodeMock = $this->getStatusCodeMock();

        $validResult = new ValidResult($urlMock, $bodyMock, $timeToFirstByteMock, $statusCodeMock);
        $this->assertTrue($validResult->isValidResult());
    }

    public function testCatGetAsString()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getBodyMock();
        $bodyMock->expects($this->once())
            ->method('asString')
            ->willReturn('HelloWorld');

        $timeToFirstByteMock = $this->getTimeToFirstByteMock();
        $timeToFirstByteMock->expects($this->once())
            ->method('inMilliseconds')
            ->willReturn(555);

        $statusCodeMock = $this->getStatusCodeMock();
        $statusCodeMock->expects($this->once())
            ->method('asInteger')
            ->willReturn(222);

        $validResult = new ValidResult($urlMock, $bodyMock, $timeToFirstByteMock, $statusCodeMock);

        $expectedString = "StatusCode: 222\nTimeToFirstByte: 555\nBody: HelloWorld";
        $this->assertSame($expectedString, $validResult->asString());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Url
     */
    private function getUrlMock()
    {
        return $this->createMock(Url::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Body
     */
    private function getBodyMock()
    {
        return $this->createMock(Body::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|TimeToFirstByte
     */
    private function getTimeToFirstByteMock()
    {
        return $this->createMock(TimeToFirstByte::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|StatusCode
     */
    private function getStatusCodeMock()
    {
        return $this->createMock(StatusCode::class);
    }
}