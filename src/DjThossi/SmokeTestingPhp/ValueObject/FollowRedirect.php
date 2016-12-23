<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsBooleanTrait;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;

class FollowRedirect
{
    use EnsureIsBooleanTrait;

    /**
     * @var bool
     */
    private $follow;

    /**
     * @param bool $follow
     */
    public function __construct($follow)
    {
        $this->ensureFollow($follow);

        $this->follow = $follow;
    }

    /**
     * @return bool
     */
    public function asBoolean()
    {
        return $this->follow;
    }

    /**
     * @param mixed $follow
     */
    private function ensureFollow($follow)
    {
        $this->ensureIsBoolean('Follow', InvalidValueException::FOLLOW_IS_NOT_A_BOOLEAN, $follow);
    }
}
