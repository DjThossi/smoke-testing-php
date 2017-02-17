<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit\Options;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\Options\SmokeTestOptions;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Options\SmokeTestOptions
 */
class SmokeTestOptionsTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstanceWithoutBasicAuth()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock
        );
        $this->assertInstanceOf(SmokeTestOptions::class, $smokeTestOptions);
    }

    public function testCanCreateInstanceWithBasicAuth()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock,
            $basicAuthMock
        );
        $this->assertInstanceOf(SmokeTestOptions::class, $smokeTestOptions);
    }

    public function testCanGetBasicAuth()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock,
            $basicAuthMock
        );
        $this->assertSame($basicAuthMock, $smokeTestOptions->getBasicAuth());
    }

    public function testCanGetUrls()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock,
            $basicAuthMock
        );
        $this->assertSame($urlsMock, $smokeTestOptions->getUrls());
    }

    public function testCanGetRequestTimeout()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock,
            $basicAuthMock
        );
        $this->assertSame($requestTimeoutMock, $smokeTestOptions->getRequestTimeout());
    }

    public function testCanGetFollowRedirect()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock,
            $basicAuthMock
        );
        $this->assertSame($followRedirectMock, $smokeTestOptions->getFollowRedirect());
    }

    public function testCanGetConcurrency()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock,
            $basicAuthMock
        );
        $this->assertSame($concurrencyMock, $smokeTestOptions->getConcurrency());
    }

    public function testCanGetBodyLength()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $smokeTestOptions = new SmokeTestOptions(
            $urlsMock,
            $requestTimeoutMock,
            $followRedirectMock,
            $concurrencyMock,
            $bodyLengthMock,
            $basicAuthMock
        );
        $this->assertSame($bodyLengthMock, $smokeTestOptions->getBodyLength());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|UrlCollection
     */
    private function getUrlCollectionMock()
    {
        return $this->createMock(UrlCollection::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|RequestTimeout
     */
    private function getRequestTimeoutMock()
    {
        return $this->createMock(RequestTimeout::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|FollowRedirect
     */
    private function getFollowRedirectMock()
    {
        return $this->createMock(FollowRedirect::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Concurrency
     */
    private function getConcurrencyMock()
    {
        return $this->createMock(Concurrency::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|BodyLength
     */
    private function getBodyLengthMock()
    {
        return $this->createMock(BodyLength::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|BasicAuth
     */
    private function getBasicAuthMock()
    {
        return $this->createMock(BasicAuth::class);
    }
}
