<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;

class RequestOptions
{
    /**
     * @var Url
     */
    private $url;

    /**
     * @var RequestTimeout
     */
    private $timeout;

    /**
     * @var FollowRedirect
     */
    private $followRedirect;

    /**
     * @var BasicAuth|null
     */
    private $basicAuth;

    /**
     * @param $url
     * @param RequestTimeout $timeout
     * @param FollowRedirect $followRedirect
     * @param BasicAuth|null $basicAuth
     */
    public function __construct(
        Url $url,
        RequestTimeout $timeout,
        FollowRedirect $followRedirect,
        BasicAuth $basicAuth = null
    ) {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->followRedirect = $followRedirect;
        $this->basicAuth = $basicAuth;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return RequestTimeout
     */
    public function getTimeout()
    {
        return $this->timeout;
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

    /**
     * @return bool
     */
    public function needsBasicAuth()
    {
        return $this->basicAuth !== null;
    }
}
