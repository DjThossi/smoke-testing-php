<?php
namespace DjThossi\SmokeTestingPhp;

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
