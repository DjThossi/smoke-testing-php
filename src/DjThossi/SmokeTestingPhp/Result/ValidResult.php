<?php
namespace DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\SmokeTestException;
use DjThossi\SmokeTestingPhp\ValueObject\Body;
use DjThossi\SmokeTestingPhp\ValueObject\Url;

class ValidResult implements Result
{
    /**
     * @var Url
     */
    private $url;

    /**
     * @var Body
     */
    private $body;

    /**
     * @var int
     */
    private $timeToFirstByteInMilliseconds;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param Url $url
     * @param Body $body
     * @param float $timeToFirstByte
     * @param int $statusCode
     */
    public function __construct(Url $url, Body $body, $timeToFirstByte, $statusCode)
    {
        $this->ensureValidTimeToFirstByte($timeToFirstByte);
        $this->ensureValidStatusCode($statusCode);

        $this->url = $url;
        $this->body = $body;
        $this->timeToFirstByteInMilliseconds = $timeToFirstByte;
        $this->statusCode = $statusCode;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return Body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return int
     */
    public function getTimeToFirstByteInMilliseconds()
    {
        return $this->timeToFirstByteInMilliseconds;
    }

    /**
     * Returns a string including statuscode, time to first byte and body.
     *
     * @return string
     */
    public function asFailureMessage()
    {
        return sprintf(
            "StatusCode: %s\nTimeToFirstByte: %u\nBody: %s",
            $this->statusCode,
            $this->timeToFirstByteInMilliseconds,
            $this->body->asString()
        );
    }

    /**
     * @return bool
     */
    public function isValidResult()
    {
        return true;
    }

    /**
     * @param float $timeToFirstByte
     *
     * TODO use ensuure
     *
     * @throws SmokeTestException
     */
    private function ensureValidTimeToFirstByte($timeToFirstByte)
    {
        if (!is_float($timeToFirstByte)) {
            $message = sprintf(
                'Expected timeToFirstByte to be float, got "%s"',
                is_object($timeToFirstByte) ? get_class($timeToFirstByte) : gettype($timeToFirstByte)
            );
            throw new SmokeTestException($message);
        }
    }

    /**
     * @param int $statusCode
     *
     * @throws SmokeTestException
     */
    private function ensureValidStatusCode($statusCode)
    {
        if (!is_int($statusCode)) {
            $message = sprintf(
                'Expected statusCode to be integer, got "%s"',
                is_object($statusCode) ? get_class($statusCode) : gettype($statusCode)
            );
            throw new SmokeTestException($message);
        }
    }
}
