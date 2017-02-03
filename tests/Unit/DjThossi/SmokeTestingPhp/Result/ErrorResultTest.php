<?php
namespace Unit\DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\Collection\HeaderCollection;
use DjThossi\SmokeTestingPhp\Result\ErrorResult;
use DjThossi\SmokeTestingPhp\Result\NotImplementedException;
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
            $this->getHeaderCollectionMock(),
            $this->getErrorMessageMock()
        );
        $this->assertInstanceOf(ErrorResult::class, $errorResult);
    }

    public function testCanCreateFromPrimitives()
    {
        $validResult = ErrorResult::fromPrimitives('http://loclahost', [], 'error message');
        $this->assertInstanceOf(ErrorResult::class, $validResult);
    }

    public function testCanGetUrl()
    {
        $urlMock = $this->getUrlMock();
        $headerCollectionMock = $this->getHeaderCollectionMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $headerCollectionMock, $errorMessageMock);
        $this->assertSame($urlMock, $errorResult->getUrl());
    }

    public function testCanGetHeaders()
    {
        $urlMock = $this->getUrlMock();
        $headerCollectionMock = $this->getHeaderCollectionMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $headerCollectionMock, $errorMessageMock);
        $this->assertSame($headerCollectionMock, $errorResult->getHeaders());
    }

    public function testCanGetBody()
    {
        $urlMock = $this->getUrlMock();
        $headerCollectionMock = $this->getHeaderCollectionMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage('getBody is not implemented');

        $errorResult = new ErrorResult($urlMock, $headerCollectionMock, $errorMessageMock);
        $errorResult->getBody();
    }

    public function testCanGetTimeToFirstByte()
    {
        $urlMock = $this->getUrlMock();
        $headerCollectionMock = $this->getHeaderCollectionMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage('getTimeToFirstByte is not implemented');

        $errorResult = new ErrorResult($urlMock, $headerCollectionMock, $errorMessageMock);
        $errorResult->getTimeToFirstByte();
    }

    public function testCanGetStatusCode()
    {
        $urlMock = $this->getUrlMock();
        $headerCollectionMock = $this->getHeaderCollectionMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage('getStatusCode is not implemented');

        $errorResult = new ErrorResult($urlMock, $headerCollectionMock, $errorMessageMock);
        $errorResult->getStatusCode();
    }

    public function testIsErrorResult()
    {
        $urlMock = $this->getUrlMock();
        $headerCollectionMock = $this->getHeaderCollectionMock();
        $errorMessageMock = $this->getErrorMessageMock();

        $errorResult = new ErrorResult($urlMock, $headerCollectionMock, $errorMessageMock);
        $this->assertFalse($errorResult->isValidResult());
    }

    public function testCatGetAsString()
    {
        $urlMock = $this->getUrlMock();
        $headerCollectionMock = $this->getHeaderCollectionMock();
        $errorMessageMock = $this->getErrorMessageMock();
        $errorMessageMock->expects($this->once())
            ->method('asString')
            ->willReturn('HelloWorld');

        $errorResult = new ErrorResult($urlMock, $headerCollectionMock, $errorMessageMock);

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

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|HeaderCollection
     */
    private function getHeaderCollectionMock()
    {
        return $this->createMock(HeaderCollection::class);
    }
}
