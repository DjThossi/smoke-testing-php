<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\Result\ValidResult;

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
        foreach ($resultCollection as $key => $result) {
            $retValue[$key] = [$result];
        }

        return $retValue;
    }

    /**
     * @param Result $result
     */
    protected function assertSuccess(Result $result)
    {
        $this->assertInstanceOf(ValidResult::class, $result, $result->asFailureMessage());

        /* @var ValidResult $result */
        $this->assertSame(200, $result->getStatusCode(), $result->asFailureMessage());
    }

    /**
     * @param ResponseTimeout $responseTimeout
     * @param Result $result
     */
    protected function assertTimeToFirstByteBelow(ResponseTimeout $responseTimeout, Result $result)
    {
        $this->assertLessThanOrEqual(
            $responseTimeout->inMilliSeconds(),
            $result->getTimeToFirstByteInMilliseconds(),
            $result->asFailureMessage()
        );
    }

    /**
     * @param Result $result
     */
    protected function assertBodyNotEmpty(Result $result)
    {
        $this->assertNotEmpty($result->getBody(), $result->asFailureMessage());
    }
}
