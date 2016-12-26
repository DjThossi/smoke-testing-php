<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Options\RequestOptions;

interface HttpRunner
{
    /**
     * @param RequestOptions $requestOptions
     */
    public function addRequest(RequestOptions $requestOptions);

    /**
     * @return ResultCollection
     */
    public function run();
}
