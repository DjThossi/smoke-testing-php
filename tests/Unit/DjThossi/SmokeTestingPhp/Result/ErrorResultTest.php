<?php
namespace Unit\DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\Result\ErrorResult;
use DjThossi\SmokeTestingPhp\ValueObject\ErrorMessage;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Result\ErrorResult
 * @covers \DjThossi\SmokeTestingPhp\Result\Result
 */
class ErrorResultTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $errorResult = new ErrorResult(
            $this->getUrlMock(),
            $this->getErrorMessageMock()
        );
        $this->assertInstanceOf(ErrorResult::class, $errorResult);
    }

    public function testCanGetUrl()
    {
        $urlMock = $this->getUrlMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $errorMessageMock);
        $this->assertSame($urlMock, $errorResult->getUrl());
    }

    public function testCanGetBody()
    {
        $urlMock = $this->getUrlMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $errorMessageMock);
        $this->assertNull($errorResult->getBody());
    }

    public function testCanGetTimeToFirstByte()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $bodyMock);
        $this->assertNull($errorResult->getTimeToFirstByte());
    }

    public function testCanGetStatusCode()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $bodyMock);
        $this->assertNull($errorResult->getStatusCode());
    }

    public function testIsErrorResult()
    {
        $urlMock = $this->getUrlMock();
        $bodyMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $bodyMock);
        $this->assertFalse($errorResult->isValidResult());
    }

    public function testCatGetAsString()
    {
        $urlMock = $this->getUrlMock();
        $errorMessageMock = $this->getErrorMessageMock();
        $errorMessageMock->expects($this->once())
            ->method('asString')
            ->willReturn('HelloWorld');

        $errorResult = new ErrorResult($urlMock, $errorMessageMock);

        $expectedString = 'HelloWorld';
        $this->assertSame($expectedString, $errorResult->asString());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Url
     */
    private function getUrlMock()
    {
        return $this->createMock(Url::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ErrorMessage
     */
    private function getErrorMessageMock()
    {
        return $this->createMock(ErrorMessage::class);
    }
}
