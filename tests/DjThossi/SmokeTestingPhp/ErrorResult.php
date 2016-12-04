<?php
namespace DjThossi\SmokeTestingPhp;

class ErrorResult implements ResultInterface
{
    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @param string $errorMessage
     *
     * @throws SmokeTestException
     */
    public function __construct($errorMessage)
    {
        $this->ensureValidErrorMessage($errorMessage);

        $this->errorMessage = $errorMessage;
    }

    /**
     * Returns a string including statuscode, time to first byte and body.
     *
     * @return string
     */
    public function asFailureMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $body
     *
     * @throws SmokeTestException
     */
    private function ensureValidErrorMessage($body)
    {
        if (!is_string($body)) {
            $message = sprintf(
                'Expected body to be string, got "%s"',
                is_object($body) ? get_class($body) : gettype($body)
            );
            throw new SmokeTestException($message);
        }
    }
}
