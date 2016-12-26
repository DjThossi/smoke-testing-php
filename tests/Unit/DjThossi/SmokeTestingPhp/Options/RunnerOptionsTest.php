<?php
namespace Unit\DjThossi\SmokeTestingPhp\Options;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\Options\RunnerOptions;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Options\RunnerOptions
 */
class RunnerOptionsTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstanceWithoutBasicAuth()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();

        $runnerOptions = new RunnerOptions($urlsMock, $requestTimeoutMock, $followRedirectMock);
        $this->assertInstanceOf(RunnerOptions::class, $runnerOptions);
    }

    public function testCanCreateInstanceWithBasicAuth()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $runnerOptions = new RunnerOptions($urlsMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertInstanceOf(RunnerOptions::class, $runnerOptions);
    }

    public function testCanGetBasicAuth()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $runnerOptions = new RunnerOptions($urlsMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($basicAuthMock, $runnerOptions->getBasicAuth());
    }

    public function testCanGetUrls()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $runnerOptions = new RunnerOptions($urlsMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($urlsMock, $runnerOptions->getUrls());
    }

    public function testCanGetTimeout()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $runnerOptions = new RunnerOptions($urlsMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($requestTimeoutMock, $runnerOptions->getRequestTimeout());
    }

    public function testCanGetFollowRedirect()
    {
        $urlsMock = $this->getUrlCollectionMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $runnerOptions = new RunnerOptions($urlsMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);
        $this->assertSame($followRedirectMock, $runnerOptions->getFollowRedirect());
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
     * @return PHPUnit_Framework_MockObject_MockObject|BasicAuth
     */
    private function getBasicAuthMock()
    {
        return $this->createMock(BasicAuth::class);
    }
}
