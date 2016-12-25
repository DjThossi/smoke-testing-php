<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;

trait SmokeTestTrait
{
    /**
     * @param SmokeTestOptions $smokeTestOptions
     *
     * @return array
     */
    protected function runSmokeTests(SmokeTestOptions $smokeTestOptions)
    {
        $httpRunner = new CurlHttpRunner(
            $smokeTestOptions->getConcurrency(),
            $smokeTestOptions->getBodyLength()
        );

        $runner = new SmokeTestRunner($httpRunner);

        $runnerOptions = new RunnerOptions(
            $smokeTestOptions->getUrls(),
            $smokeTestOptions->getFollowRedirect(),
            $smokeTestOptions->getRequestTimeout(),
            $smokeTestOptions->getBasicAuth()
        );

        $resultCollection = $runner->run($runnerOptions);

        return $this->convertResultCollectionToDataProviderArray($resultCollection);
    }

    /**
     * @param ResultCollection $resultCollection
     *
     * @return array
     */
    protected function convertResultCollectionToDataProviderArray(ResultCollection $resultCollection)
    {
        $retValue = [];
        /** @var Result $result */
        foreach ($resultCollection as $key => $result) {
            $key = sprintf('#%d: %s', $key, $result->getUrl()->asString());
            $retValue[$key] = [$result];
        }

        return $retValue;
    }

    /**
     * @param Result $result
     */
    protected function assertSuccess(Result $result)
    {
        $this->assertTrue($result->isValidResult(), $result->asString());

        $this->assertSame(200, $result->getStatusCode()->asInteger(), $result->asString());
    }

    /**
     * @param TimeToFirstByte $maxTimeToFirstByte
     * @param Result $result
     */
    protected function assertTimeToFirstByteBelow(TimeToFirstByte $maxTimeToFirstByte, Result $result)
    {
        $this->assertLessThanOrEqual(
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
        $this->assertNotNull($result->getBody(), $result->asString());
        $this->assertNotEmpty($result->getBody()->asString(), $result->asString());
    }
}