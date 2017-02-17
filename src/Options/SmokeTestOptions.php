<?php
namespace DjThossi\SmokeTestingPhp\Options;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;

class SmokeTestOptions
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
     * @var Concurrency
     */
    private $concurrency;

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
     * @param RequestTimeout $requestTimeout
     * @param FollowRedirect $followRedirect
     * @param Concurrency $concurrency
     * @param BodyLength $bodyLength
     * @param BasicAuth|null $basicAuth
     */
    public function __construct(
        UrlCollection $urls,
        RequestTimeout $requestTimeout,
        FollowRedirect $followRedirect,
        Concurrency $concurrency,
        BodyLength $bodyLength,
        BasicAuth $basicAuth = null
    ) {
        $this->urls = $urls;
        $this->requestTimeout = $requestTimeout;
        $this->followRedirect = $followRedirect;
        $this->concurrency = $concurrency;
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
     * @return Concurrency
     */
    public function getConcurrency()
    {
        return $this->concurrency;
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
