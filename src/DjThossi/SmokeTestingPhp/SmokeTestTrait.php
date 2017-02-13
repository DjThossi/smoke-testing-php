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
        $errorMessage = "This SmokeTest was not successful\n" . $result->asString();

        Assert::assertTrue($result->isValidResult(), $errorMessage);
        Assert::assertSame(200, $result->getStatusCode()->asInteger(), $errorMessage);
    }

    /**
     * @param TimeToFirstByte $maxTimeToFirstByte
     * @param Result $result
     */
    protected function assertTimeToFirstByteBelow(TimeToFirstByte $maxTimeToFirstByte, Result $result)
    {
        $errorMessage = "This SmokeTest was to slow\n" . $result->asString();

        Assert::assertLessThanOrEqual(
            $maxTimeToFirstByte->inMilliSeconds(),
            $result->getTimeToFirstByte()->inMilliSeconds(),
            $errorMessage
        );
    }

    /**
     * @param Result $result
     */
    protected function assertBodyNotEmpty(Result $result)
    {
        $errorMessage = "The body of this SmokeTest is empty\n" . $result->asString();

        Assert::assertNotEmpty($result->getBody()->asString(), $errorMessage);
    }

    /**
     * @param HeaderKey $key
     * @param Result $result
     */
    protected function assertHeaderKeyExists(HeaderKey $key, Result $result)
    {
        $errorMessage = "HeaderKey not found in this SmokeTest\n" . $result->asString();

        Assert::assertGreaterThan(0, $result->getHeaders()->count(), $errorMessage);
        Assert::assertTrue($result->getHeaders()->headerKeyExists($key), $errorMessage);
    }

    /**
     * @param Header $searchHeader
     * @param Result $result
     */
    protected function assertHasHeader(Header $searchHeader, Result $result)
    {
        $errorMessage = "Header not found in this SmokeTest\n" . $result->asString();

        Assert::assertGreaterThan(0, $result->getHeaders()->count(), $errorMessage);
        Assert::assertTrue($result->getHeaders()->headerExists($searchHeader), $errorMessage);
    }

    /**
     * @param Header $searchHeader
     * @param Result $result
     */
    protected function assertNotHasHeader(Header $searchHeader, Result $result)
    {
        $errorMessage = "Header found in this SmokeTest\n" . $result->asString();

        Assert::assertFalse($result->getHeaders()->headerExists($searchHeader), $errorMessage);
    }
}
