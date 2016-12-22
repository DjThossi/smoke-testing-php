<?php
namespace DjThossi\SmokeTestingPhp;

class FollowRedirect
{
    /**
     * @var bool
     */
    private $follow;

    /**
     * @param bool $follow
     */
    public function __construct($follow)
    {
        $this->follow = $follow;
    }

    /**
     * @return bool
     */
    public function asBoolean()
    {
        return $this->follow;
    }
}
