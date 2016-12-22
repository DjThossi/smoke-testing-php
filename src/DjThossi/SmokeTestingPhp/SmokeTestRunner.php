<?php
namespace DjThossi\SmokeTestingPhp;

class SmokeTestRunner
{
    /**
     * @var HttpRunner
     */
    private $httpRunner;

    public function __construct(HttpRunner $httpRunner)
    {
        $this->httpRunner = $httpRunner;
    }

    /**
     * @param RunnerOptions $runnerOptions
     *
     * @return array
     */
    public function run(RunnerOptions $runnerOptions)
    {
        foreach ($runnerOptions->getUrls() as $url) {
            //TODO log only with parameter
            //TODO move in Sucess and error
            echo '.';

            $this->httpRunner->addRequest(
                new RequestOptions(
                    $url,
                    $runnerOptions->getRequestTimeout(),
                    $runnerOptions->getFollowRedirect(),
                    $runnerOptions->getBasicAuth()
                )
            );
        }

        $resultCollection = $this->httpRunner->run();

        $retValue = [];
        foreach ($resultCollection as $key => $result) {
            $retValue[$key] = [$result];
        }

        return $retValue;
    }
}
