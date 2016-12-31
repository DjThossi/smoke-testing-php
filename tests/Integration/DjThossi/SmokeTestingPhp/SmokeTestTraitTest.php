<?php
namespace Example\DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\Options\SmokeTestOptions;
use DjThossi\SmokeTestingPhp\Result\ErrorResult;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\Result\ValidResult;
use DjThossi\SmokeTestingPhp\SmokeTestTrait;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\Body;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use DjThossi\SmokeTestingPhp\ValueObject\StatusCode;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\SmokeTestTrait
 */
class SmokeTestTraitTest extends PHPUnit_Framework_TestCase
{
    use SmokeTestTrait;

    public function testRunSmokeTestsWithEmptyUrls()
    {
        $urls = [];

        $options = $this->createSmokeTestOptions($urls);

        $dataProviderResults = $this->runSmokeTests($options);
        $this->assertInternalType('array', $dataProviderResults);
        $this->assertEmpty($dataProviderResults);
    }

    public function testRunSmokeTestsWithWorkingUrl()
    {
        $url = 'http://www.example.com';

        $options = $this->createSmokeTestOptions([$url]);

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

        $options = $this->createSmokeTestOptions([$url]);

        $dataProviderResults = $this->runSmokeTests($options);
        $this->assertInternalType('array', $dataProviderResults);
        $this->assertCount(1, $dataProviderResults);
        $this->assertArrayHasKey('#0: http://localhost/not-working.html', $dataProviderResults);
        $this->assertInternalType('array', $dataProviderResults['#0: http://localhost/not-working.html']);
        $this->assertCount(1, $dataProviderResults['#0: http://localhost/not-working.html']);
        $this->assertInstanceOf(ErrorResult::class, $dataProviderResults['#0: http://localhost/not-working.html'][0]);
    }

    public function testAssertSuccess()
    {
        $result = $this->createValidResult();
        $this->assertSuccess($result);
    }

    public function testAssertTimeToFirstByteBelow()
    {
        $result = $this->createValidResult();
        $this->assertTimeToFirstByteBelow(new TimeToFirstByte(2000), $result);
    }

    public function testAssertBodyNotEmpty()
    {
        $result = $this->createValidResult('HelloWorld');

        $this->assertBodyNotEmpty($result);
    }

    /**
     * @param array $urls
     *
     * @return SmokeTestOptions
     */
    private function createSmokeTestOptions(array $urls)
    {
        $options = new SmokeTestOptions(
            UrlCollection::fromStrings($urls),
            new RequestTimeout(2),
            new FollowRedirect(true),
            new Concurrency(10),
            new BodyLength(500),
            new BasicAuth('username', 'password')
        );

        return $options;
    }

    /**
     * @param string $body
     *
     * @return ValidResult
     */
    private function createValidResult($body = '')
    {
        $result = new ValidResult(
            new Url('http://www.example.com'),
            new Body($body),
            new TimeToFirstByte(100),
            new StatusCode(200)
        );

        return $result;
    }
}
