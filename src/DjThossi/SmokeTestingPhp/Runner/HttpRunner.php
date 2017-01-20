<?php
namespace DjThossi\SmokeTestingPhp\Runner;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Options\RequestOptions;

interface HttpRunner
{
    /**
     * @param RequestOptions $requestOptions
     *
     * @return void
     */
    public function addRequest(RequestOptions $requestOptions);

    /**
     * @return ResultCollection
     */
    public function run();
}
