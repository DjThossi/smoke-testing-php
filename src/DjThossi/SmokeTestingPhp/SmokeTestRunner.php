<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Options\RequestOptions;

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
     * @return ResultCollection
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

        return $this->httpRunner->run();
    }
}
