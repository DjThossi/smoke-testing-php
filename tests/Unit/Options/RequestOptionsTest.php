<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit\Options;

use DjThossi\SmokeTestingPhp\Options\RequestOptions;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Options\RequestOptions
 */
class RequestOptionsTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstanceWithoutBasicAuth()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock);
        $this->assertInstanceOf(RequestOptions::class, $requestOptions);
    }

    public function testCanCreateInstanceWithBasicAuth()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertInstanceOf(RequestOptions::class, $requestOptions);
    }

    public function testDoesNeedBasicAuth()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertTrue($requestOptions->needsBasicAuth());
    }

    public function testDoesNotNeedBasicAuth()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock);
        $this->assertFalse($requestOptions->needsBasicAuth());
    }

    public function testCanGetBasicAuth()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($basicAuthMock, $requestOptions->getBasicAuth());
    }

    public function testCanGetUrl()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($urlMock, $requestOptions->getUrl());
    }

    public function testCanGetRequestTimeout()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($requestTimeoutMock, $requestOptions->getRequestTimeout());
    }

    public function testCanGetFollowRedirect()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($followRedirectMock, $requestOptions->getFollowRedirect());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Url
     */
    private function getUrlMock()
    {
        return $this->createMock(Url::class);
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
     * @return PHPUnit_Framework_MockObject_MockObject|BasicAuth
     */
    private function getBasicAuthMock()
    {
        return $this->createMock(BasicAuth::class);
    }
}
