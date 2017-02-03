<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Options\RunnerOptions;
use DjThossi\SmokeTestingPhp\Options\SmokeTestOptions;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\Runner\CurlHttpRunner;
use DjThossi\SmokeTestingPhp\ValueObject\Header;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use PHPUnit\Framework\Assert;

trait SmokeTestTrait
{
    /**
     * @param Result $result
     */
    public function successOutput(Result $result)
    {
        //Please override this method in you test class if you would like to do an output
    }

    /**
     * @param Result $result
     */
    public function errorOutput(Result $result)
    {
        //Please override this method in you test class if you would like to do an output
    }

    /**
     * @param SmokeTestOptions $smokeTestOptions
     *
     * @return array
     */
    protected function runSmokeTests(SmokeTestOptions $smokeTestOptions)
    {
        $httpRunner = new CurlHttpRunner(
            $smokeTestOptions->getConcurrency(),
            $smokeTestOptions->getBodyLength(),
            [$this, 'successOutput'],
            [$this, 'errorOutput']
        );

        $runner = new SmokeTest($httpRunner);

        $runnerOptions = new RunnerOptions(
            $smokeTestOptions->getUrls(),
            $smokeTestOptions->getRequestTimeout(),
            $smokeTestOptions->getFollowRedirect(),
            $smokeTestOptions->getBasicAuth()
        );

        $resultCollection = $runner->run($runnerOptions);

        return $resultCollection->asDataProviderArray();
    }

    /**
     * @param Result $result
     */
    protected function assertSuccess(Result $result)
    {
        Assert::assertTrue($result->isValidResult(), $result->asString());
        Assert::assertSame(200, $result->getStatusCode()->asInteger(), $result->asString());
    }

    /**
     * @param TimeToFirstByte $maxTimeToFirstByte
     * @param Result $result
     */
    protected function assertTimeToFirstByteBelow(TimeToFirstByte $maxTimeToFirstByte, Result $result)
    {
        Assert::assertLessThanOrEqual(
            $maxTimeToFirstByte->inMilliSeconds(),
            $result->getTimeToFirstByte()->inMilliSeconds(),
            $result->asString()
        );
    }

    /**
     * @param Result $result
     */
    protected function assertBodyNotEmpty(Result $result)
    {
        Assert::assertNotNull($result->getBody(), $result->asString());
        Assert::assertNotEmpty($result->getBody()->asString(), $result->asString());
    }

    /**
     * @param HeaderKey $key
     * @param Result $result
     */
    protected function assertHeaderKeyExists(HeaderKey $key, Result $result)
    {
        Assert::assertNotNull($result->getHeaders(), $result->asString());
        Assert::assertGreaterThan(0, $result->getHeaders()->count(), $result->asString());
        Assert::assertTrue($result->getHeaders()->headerKeyExists($key), $result->asString());
    }

    /**
     * @param Header $searchHeader
     * @param Result $result
     */
    protected function assertHeaderExists(Header $searchHeader, Result $result)
    {
        Assert::assertNotNull($result->getHeaders(), $result->asString());
        Assert::assertGreaterThan(0, $result->getHeaders()->count(), $result->asString());
        Assert::assertTrue($result->getHeaders()->headerExists($searchHeader), $result->asString());
    }
}
