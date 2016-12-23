<?php
namespace DjThossi\SmokeTestingPhp;

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
     * @var FollowRedirect
     */
    private $followRedirect;

    /**
     * @var RequestTimeout
     */
    private $requestTimeout;

    /**
     * @var BasicAuth|null
     */
    private $basicAuth;

    /**
     * @param UrlCollection $urls
     * @param FollowRedirect $followRedirect
     * @param RequestTimeout $requestTimeout
     * @param BasicAuth|null $basicAuth
     */
    public function __construct(
        UrlCollection $urls,
        FollowRedirect $followRedirect,
        RequestTimeout $requestTimeout,
        BasicAuth $basicAuth = null
    ) {
        $this->urls = $urls;
        $this->followRedirect = $followRedirect;
        $this->requestTimeout = $requestTimeout;
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
     * @return FollowRedirect
     */
    public function getFollowRedirect()
    {
        return $this->followRedirect;
    }

    /**
     * @return RequestTimeout
     */
    public function getRequestTimeout()
    {
        return $this->requestTimeout;
    }

    /**
     * @return BasicAuth|null
     */
    public function getBasicAuth()
    {
        return $this->basicAuth;
    }
}
