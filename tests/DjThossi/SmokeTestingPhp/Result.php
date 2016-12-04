<?php
namespace DjThossi\SmokeTestingPhp;

class Result implements ResultInterface
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var int
     */
    private $timeToFirstByte;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param string $body
     * @param float $timeToFirstByte
     * @param int $statusCode
     *
     * @throws SmokeTestException
     */
    public function __construct($body, $timeToFirstByte, $statusCode)
    {
        $this->ensureValidBody($body);
        $this->ensureValidTimeToFirstByte($timeToFirstByte);
        $this->ensureValidStatusCode($statusCode);

        $this->body = $body;
        $this->timeToFirstByte = $timeToFirstByte;
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
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
    public function getTimeToFirstByte()
    {
        return $this->timeToFirstByte;
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
            $this->timeToFirstByte,
            $this->body
        );
    }

    /**
     * @param string $body
     *
     * @throws SmokeTestException
     */
    private function ensureValidBody($body)
    {
        if (!is_string($body)) {
            $message = sprintf(
                'Expected body to be string, got "%s"',
                is_object($body) ? get_class($body) : gettype($body)
            );
            throw new SmokeTestException($message);
        }
    }

    /**
     * @param float $timeToFirstByte
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
