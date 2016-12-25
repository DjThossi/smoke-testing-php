<?php
namespace DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\SmokeTestException;
use DjThossi\SmokeTestingPhp\ValueObject\Url;

class ErrorResult implements Result
{
    /**
     * @var Url
     */
    private $url;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @param Url $url
     * @param string $errorMessage
     */
    public function __construct(Url $url, $errorMessage)
    {
        $this->ensureValidErrorMessage($errorMessage);

        $this->url = $url;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     *
     * TODO use Proper Ensure Traits
     *
     * @throws SmokeTestException
     */
    private function ensureValidErrorMessage($errorMessage)
    {
        if (!is_string($errorMessage)) {
            $message = sprintf(
                'Expected body to be string, got "%s"',
                is_object($errorMessage) ? get_class($errorMessage) : gettype($errorMessage)
            );
            throw new SmokeTestException($message);
        }
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function getTimeToFirstByte()
    {
        return null;
    }

    public function getBody()
    {
        return null;
    }

    public function getStatusCode()
    {
        return null;
    }

    /**
     * @return bool
     */
    public function isValidResult()
    {
        return false;
    }
}
