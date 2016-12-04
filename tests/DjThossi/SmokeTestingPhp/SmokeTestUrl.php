<?php
namespace DjThossi\SmokeTestingPhp;

class SmokeTestUrl
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $timeoutInSeconds;

    /**
     * @param string $url
     * @param int $timeoutInSeconds
     * @param string $username
     * @param string $password
     *
     * @throws SmokeTestException
     */
    public function __construct($url, $timeoutInSeconds, $username = null, $password = null)
    {
        $this->ensureUrl($url);
        $this->ensureTimeoutInSeconds($timeoutInSeconds);
        $this->ensureUsername($username);
        $this->ensurePassword($password);

        $this->url = $url;
        $this->timeoutInSeconds = $timeoutInSeconds;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getTimeoutInSeconds()
    {
        return $this->timeoutInSeconds;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function needsBasicAuth()
    {
        return ($this->getUsername() !== null);
    }

    /**
     * @param $url
     *
     * @throws SmokeTestException
     */
    private function ensureUrl($url)
    {
        if (!is_string($url)) {
            $message = sprintf(
                'Expected url to be string, got "%s"',
                is_object($url) ? get_class($url) : gettype($url)
            );
            throw new SmokeTestException($message);
        }
    }

    /**
     * @param $timeoutInSeconds
     *
     * @throws SmokeTestException
     */
    private function ensureTimeoutInSeconds($timeoutInSeconds)
    {
        if (!is_int($timeoutInSeconds)) {
            $message = sprintf(
                'Expected timeoutInSeconds to be int, got "%s"',
                is_object($timeoutInSeconds) ? get_class($timeoutInSeconds) : gettype($timeoutInSeconds)
            );
            throw new SmokeTestException($message);
        }
    }

    /**
     * @param $username
     *
     * @throws SmokeTestException
     */
    private function ensureUsername($username)
    {
        if ($username == null) {
            return;
        }

        if (!is_string($username)) {
            $message = sprintf(
                'Expected username to be string or null, got "%s"',
                is_object($username) ? get_class($username) : gettype($username)
            );
            throw new SmokeTestException($message);
        }
    }

    /**
     * @param $password
     *
     * @throws SmokeTestException
     */
    private function ensurePassword($password)
    {
        if ($password == null) {
            return;
        }

        if (!is_string($password)) {
            $message = sprintf(
                'Expected password to be string or null, got "%s"',
                is_object($password) ? get_class($password) : gettype($password)
            );
            throw new SmokeTestException($message);
        }
    }
}
