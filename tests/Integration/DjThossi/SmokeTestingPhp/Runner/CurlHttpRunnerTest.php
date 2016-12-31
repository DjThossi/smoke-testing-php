<?php
namespace Integration\DjThossi\SmokeTestingPhp\Runner;

use DjThossi\SmokeTestingPhp\Options\RequestOptions;
use DjThossi\SmokeTestingPhp\Result\ErrorResult;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\Result\ValidResult;
use DjThossi\SmokeTestingPhp\Runner\CurlHttpRunner;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Runner\CurlHttpRunner
 */
class CurlHttpRunnerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param Result $result
     */
    public function successOutput(Result $result)
    {
        $this->assertInstanceOf(ValidResult::class, $result);
    }

    /**
     * @param Result $result
     */
    public function errorOutput(Result $result)
    {
        $this->assertInstanceOf(ErrorResult::class, $result);
    }

    public function testCanCreateInstance()
    {
        $concurrencyMock = $this->getConcurrencyMock();
        $bodyLengthMock = $this->getBodyLengthMock();

        $curlHttpRunner = new CurlHttpRunner(
            $concurrencyMock,
            $bodyLengthMock,
            [$this, 'successOutput'],
            [$this, 'errorOutput']
        );
        $this->assertInstanceOf(CurlHttpRunner::class, $curlHttpRunner);
    }

    public function testCanRunWithoutRequestAdded()
    {
        $curlHttpRunner = new CurlHttpRunner(
            new Concurrency(1),
            new BodyLength(0),
            [$this, 'successOutput'],
            [$this, 'errorOutput']
        );

        $results = $curlHttpRunner->run();
        $this->assertCount(0, $results);
    }

    public function testCanRunSuccess()
    {
        $url = new Url('http://www.example.com');

        $curlHttpRunner = new CurlHttpRunner(
            new Concurrency(1),
            new BodyLength(0),
            [$this, 'successOutput'],
            [$this, 'errorOutput']
        );
        $curlHttpRunner->addRequest(
            new RequestOptions(
                $url,
                new RequestTimeout(1),
                new FollowRedirect(true)
            )
        );

        $results = $curlHttpRunner->run();
        $this->assertCount(1, $results);

        /** @var Result $result */
        foreach ($results as $result) {
            $this->assertTrue($result->isValidResult());
            $this->assertEquals($url, $result->getUrl());
        }
    }

    public function testCanRunSuccessWithBasicAuth()
    {
        $url = new Url('http://www.example.com');

        $curlHttpRunner = new CurlHttpRunner(
            new Concurrency(1),
            new BodyLength(0),
            [$this, 'successOutput'],
            [$this, 'errorOutput']
        );
        $curlHttpRunner->addRequest(
            new RequestOptions(
                $url,
                new RequestTimeout(2),
                new FollowRedirect(true),
                new BasicAuth('username', 'password')
            )
        );

        $results = $curlHttpRunner->run();
        $this->assertCount(1, $results);

        /** @var Result $result */
        foreach ($results as $result) {
            $this->assertTrue($result->isValidResult());
            $this->assertEquals($url, $result->getUrl());
        }
    }

    public function testCanRunFailure()
    {
        $url = new Url('http://localhost/foo.bar');

        $curlHttpRunner = new CurlHttpRunner(
            new Concurrency(1),
            new BodyLength(0),
            [$this, 'successOutput'],
            [$this, 'errorOutput']
        );
        $curlHttpRunner->addRequest(
            new RequestOptions(
                $url,
                new RequestTimeout(1),
                new FollowRedirect(true)
            )
        );

        $results = $curlHttpRunner->run();
        $this->assertCount(1, $results);

        /** @var Result $result */
        foreach ($results as $result) {
            $this->assertFalse($result->isValidResult());
            $this->assertEquals($url, $result->getUrl());
        }
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
}
