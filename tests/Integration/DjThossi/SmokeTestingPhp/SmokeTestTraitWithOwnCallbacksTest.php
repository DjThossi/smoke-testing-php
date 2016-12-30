<?php
namespace Example\DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\Options\SmokeTestOptions;
use DjThossi\SmokeTestingPhp\Result\ErrorResult;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\SmokeTestTrait;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\SmokeTestTrait
 */
class SmokeTestTraitWithOwnCallbacksTest extends PHPUnit_Framework_TestCase
{
    use SmokeTestTrait;

    public function successOutput(Result $result)
    {
        $this->assertEquals('http://www.example.com', $result->getUrl()->asString());
    }

    public function errorOutput(Result $result)
    {
        $this->assertEquals('http://localhost/not-working.html', $result->getUrl()->asString());
    }

    public function testRunSmokeTestsWithWorkingUrl()
    {
        $url = 'http://www.example.com';

        $options = new SmokeTestOptions(
            UrlCollection::fromStrings([$url]),
            new RequestTimeout(1),
            new FollowRedirect(true),
            new Concurrency(10),
            new BodyLength(500),
            new BasicAuth('username', 'password')
        );

        $dataProviderResults = $this->runSmokeTests($options);
        $this->assertInternalType('array', $dataProviderResults);
        $this->assertCount(1, $dataProviderResults);
        $this->assertArrayHasKey('#0: http://www.example.com', $dataProviderResults);
        $this->assertInternalType('array', $dataProviderResults['#0: http://www.example.com']);
        $this->assertCount(1, $dataProviderResults['#0: http://www.example.com']);
        $this->assertInstanceOf(Result::class, $dataProviderResults['#0: http://www.example.com'][0]);
    }

    public function testRunSmokeTestsWithNotWorkingUrl()
    {
        $url = 'http://localhost/not-working.html';

        $options = new SmokeTestOptions(
            UrlCollection::fromStrings([$url]),
            new RequestTimeout(1),
            new FollowRedirect(true),
            new Concurrency(10),
            new BodyLength(500),
            new BasicAuth('username', 'password')
        );

        $dataProviderResults = $this->runSmokeTests($options);
        $this->assertInternalType('array', $dataProviderResults);
        $this->assertCount(1, $dataProviderResults);
        $this->assertArrayHasKey('#0: http://localhost/not-working.html', $dataProviderResults);
        $this->assertInternalType('array', $dataProviderResults['#0: http://localhost/not-working.html']);
        $this->assertCount(1, $dataProviderResults['#0: http://localhost/not-working.html']);
        $this->assertInstanceOf(ErrorResult::class, $dataProviderResults['#0: http://localhost/not-working.html'][0]);
    }
}
