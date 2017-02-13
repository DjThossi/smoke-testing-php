<?php
namespace Integration\DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\HeaderCollection;
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
use DjThossi\SmokeTestingPhp\ValueObject\Header;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderValue;
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
        $url = 'http://255.255.255.255/not-working.html';

        $options = $this->createSmokeTestOptions([$url]);

        $dataProviderResults = $this->runSmokeTests($options);
        $this->assertInternalType('array', $dataProviderResults);
        $this->assertCount(1, $dataProviderResults);
        $this->assertArrayHasKey('#0: http://255.255.255.255/not-working.html', $dataProviderResults);
        $this->assertInternalType('array', $dataProviderResults['#0: http://255.255.255.255/not-working.html']);
        $this->assertCount(1, $dataProviderResults['#0: http://255.255.255.255/not-working.html']);
        $this->assertInstanceOf(
            ErrorResult::class,
            $dataProviderResults['#0: http://255.255.255.255/not-working.html'][0]
        );
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

    public function testAssertHasHeaderKey()
    {
        $headerCollection = new HeaderCollection();
        $headerCollection->addHeader(
            new Header(
                new HeaderKey('Working'),
                new HeaderValue('HelloWorld')
            )
        );

        $result = $this->createValidResult('', $headerCollection);

        $this->assertHasHeaderKey(new HeaderKey('Working'), $result);
    }

    public function testAssertHasHeader()
    {
        $headerCollection = new HeaderCollection();
        $headerCollection->addHeader(
            new Header(
                new HeaderKey('Working'),
                new HeaderValue('HelloWorld')
            )
        );

        $result = $this->createValidResult('', $headerCollection);

        $this->assertHasHeader(
            new Header(
                new HeaderKey('Working'),
                new HeaderValue('HelloWorld')
            ),
            $result
        );
    }

    public function testAssertNotHasHeader()
    {
        $headerCollection = new HeaderCollection();
        $headerCollection->addHeader(
            new Header(
                new HeaderKey('Existing'),
                new HeaderValue('HelloWorld')
            )
        );

        $result = $this->createValidResult('', $headerCollection);

        $this->assertNotHasHeader(
            new Header(
                new HeaderKey('NotExisting'),
                new HeaderValue('HelloWorld')
            ),
            $result
        );
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
     * @param HeaderCollection $headerCollection
     *
     * @return ValidResult
     */
    private function createValidResult($body = '', HeaderCollection $headerCollection = null)
    {
        if ($headerCollection === null) {
            $headerCollection = new HeaderCollection();
        }

        $result = new ValidResult(
            new Url('http://www.example.com'),
            $headerCollection,
            new Body($body),
            new TimeToFirstByte(100),
            new StatusCode(200)
        );

        return $result;
    }
}
