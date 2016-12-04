<?php
namespace DjThossi\SmokeTestingPhp;

class ExampleTest extends SmokeTest
{
    /**
     *
     * * Is Reachable (StatusCode === 200)
     * * Response body is not empty
     * * Time to first byte 100ms or less
     *
     * @dataProvider resultProvider
     *
     * @param ResultInterface $result
     */
    public function testUrl(ResultInterface $result)
    {
        $this->assertInstanceOf(Result::class, $result, $result->asFailureMessage());

        /* @var Result $result */
        $this->assertSame(200, $result->getStatusCode(), $result->asFailureMessage());
        $this->assertNotEmpty($result->getBody(), $result->asFailureMessage());
        $this->assertLessThanOrEqual(0.2, $result->getTimeToFirstByte(), $result->asFailureMessage());
    }

    /**
     * @return string
     */
    protected function getUrlsFile()
    {
        return __DIR__ . '/../../../data/urls.txt';
    }

    /**
     * @return string
     */
    protected function getBasicAuthUsername()
    {
        return null;
    }

    /**
     * @return string
     */
    protected function getBasicAuthPassword()
    {
        return null;
    }

    /**
     * @return int
     */
    protected function getMaxCurlTimeoutInSeconds()
    {
        return 2;
    }

    /**
     * @return int
     */
    protected function getMaxParallelRequests()
    {
        return 5;
    }

    /**
     * @return int
     */
    protected function getMaxBodyToPreserve()
    {
        return 500;
    }
}