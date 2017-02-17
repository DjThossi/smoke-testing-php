<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit;

use DjThossi\SmokeTestingPhp\Options\RequestOptions;
use DjThossi\SmokeTestingPhp\Options\RunnerOptions;
use DjThossi\SmokeTestingPhp\Runner\HttpRunner;
use DjThossi\SmokeTestingPhp\SmokeTest;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\SmokeTest
 */
class SmokeTestTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $smokeTest = new SmokeTest($this->getHttpRunnerMock());
        $this->assertInstanceOf(SmokeTest::class, $smokeTest);
    }

    public function testCanRun()
    {
        $urlMock = $this->getUrlMock();
        $requestTimeoutMock = $this->getRequestTimeoutMock();
        $followRedirectMock = $this->getFollowRedirectMock();
        $basicAuthMock = $this->getBasicAuthMock();

        $requestOptions = new RequestOptions($urlMock, $requestTimeoutMock, $followRedirectMock, $basicAuthMock);

        $httpRunnerMock = $this->getHttpRunnerMock();
        $httpRunnerMock->expects($this->once())
            ->method('addRequest')
            ->with($requestOptions);
        $httpRunnerMock->expects($this->once())
            ->method('run');

        $smokeTest = new SmokeTest($httpRunnerMock);

        $runnerOptionsMock = $this->getRunnerOptionsMock();
        $runnerOptionsMock->expects($this->once())
            ->method('getUrls')
            ->willReturn([$urlMock]);
        $runnerOptionsMock->expects($this->once())
            ->method('getRequestTimeout')
            ->willReturn($requestTimeoutMock);
        $runnerOptionsMock->expects($this->once())
            ->method('getFollowRedirect')
            ->willReturn($followRedirectMock);
        $runnerOptionsMock->expects($this->once())
            ->method('getBasicAuth')
            ->willReturn($basicAuthMock);

        $smokeTest->run($runnerOptionsMock);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|HttpRunner
     */
    private function getHttpRunnerMock()
    {
        return $this->createMock(HttpRunner::class);
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

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|RunnerOptions
     */
    private function getRunnerOptionsMock()
    {
        return $this->createMock(RunnerOptions::class);
    }
}
