<?php
namespace DjThossi\SmokeTestingPhp;

interface ResultInterface
{
    /**
     * @return string
     */
    public function asFailureMessage();
}
