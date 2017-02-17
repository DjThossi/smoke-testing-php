<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Options\RequestOptions;
use DjThossi\SmokeTestingPhp\Options\RunnerOptions;
use DjThossi\SmokeTestingPhp\Runner\HttpRunner;

class SmokeTest
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
