<?php
namespace DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\EnsureIsBooleanTrait;

class FollowRedirect
{
    use EnsureIsBooleanTrait;

    const FOLLOW_IS_NOT_A_BOOLEAN = 1;

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
        $this->ensureIsBoolean('Follow', $follow, self::FOLLOW_IS_NOT_A_BOOLEAN);
    }
}
