<?php
namespace DjThossi\SmokeTestingPhp;

class SmokeTestOptions
{
    /**
     * @var UrlCollection
     */
    private $urls;

    /**
     * @var Concurrency
     */
    private $concurrency;

    /**
     * @var FollowRedirect
     */
    private $followRedirect;

    /**
     * @var RequestTimeout
     */
    private $requestTimeout;

    /**
     * @var BodyLength
     */
    private $bodyLength;

    /**
     * @var BasicAuth|null
     */
    private $basicAuth;

    /**
     * @param UrlCollection $urls
     * @param Concurrency $concurrency
     * @param FollowRedirect $followRedirect
     * @param RequestTimeout $requestTimeout
     * @param BodyLength $bodyLength
     * @param BasicAuth|null $basicAuth
     */
    public function __construct(
        UrlCollection $urls,
        Concurrency $concurrency,
        FollowRedirect $followRedirect,
        RequestTimeout $requestTimeout,
        BodyLength $bodyLength,
        BasicAuth $basicAuth = null
    ) {
        $this->urls = $urls;
        $this->concurrency = $concurrency;
        $this->followRedirect = $followRedirect;
        $this->requestTimeout = $requestTimeout;
        $this->bodyLength = $bodyLength;
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
     * @return Concurrency
     */
    public function getConcurrency()
    {
        return $this->concurrency;
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
     * @return BodyLength
     */
    public function getBodyLength()
    {
        return $this->bodyLength;
    }

    /**
     * @return BasicAuth|null
     */
    public function getBasicAuth()
    {
        return $this->basicAuth;
    }
}
