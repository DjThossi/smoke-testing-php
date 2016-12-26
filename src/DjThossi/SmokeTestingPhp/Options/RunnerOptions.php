<?php
namespace DjThossi\SmokeTestingPhp\Options;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;

class RunnerOptions
{
    /**
     * @var UrlCollection
     */
    private $urls;

    /**
     * @var RequestTimeout
     */
    private $requestTimeout;

    /**
     * @var FollowRedirect
     */
    private $followRedirect;

    /**
     * @var BasicAuth|null
     */
    private $basicAuth;

    /**
     * @param UrlCollection $urls
     * @param RequestTimeout $requestTimeout
     * @param FollowRedirect $followRedirect
     * @param BasicAuth|null $basicAuth
     */
    public function __construct(
        UrlCollection $urls,
        RequestTimeout $requestTimeout,
        FollowRedirect $followRedirect,
        BasicAuth $basicAuth = null
    ) {
        $this->urls = $urls;
        $this->requestTimeout = $requestTimeout;
        $this->followRedirect = $followRedirect;
        $this->basicAuth = $basicAuth;
    }

    /**
     * @return UrlCollection
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @return RequestTimeout
     */
    public function getRequestTimeout()
    {
        return $this->requestTimeout;
    }

    /**
     * @return FollowRedirect
     */
    public function getFollowRedirect()
    {
        return $this->followRedirect;
    }

    /**
     * @return BasicAuth|null
     */
    public function getBasicAuth()
    {
        return $this->basicAuth;
    }
}
