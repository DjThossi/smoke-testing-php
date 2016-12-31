<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect
 */
class FollowRedirectTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstanceTrue()
    {
        $followRedirect = new FollowRedirect(true);
        $this->assertInstanceOf(FollowRedirect::class, $followRedirect);
    }

    public function testCanCreateInstanceFalse()
    {
        $followRedirect = new FollowRedirect(false);
        $this->assertInstanceOf(FollowRedirect::class, $followRedirect);
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $follow
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($follow, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $followRedirect = new FollowRedirect($follow);
        $this->assertInstanceOf(FollowRedirect::class, $followRedirect);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'Follow is String' => ['Hello World', FollowRedirect::FOLLOW_IS_NOT_A_BOOLEAN],
            'Follow is Float' => [1.337, FollowRedirect::FOLLOW_IS_NOT_A_BOOLEAN],
            'Follow is Integer' => [1337, FollowRedirect::FOLLOW_IS_NOT_A_BOOLEAN],
            'Follow is object' => [new stdClass(), FollowRedirect::FOLLOW_IS_NOT_A_BOOLEAN],
            'Follow is empty' => ['', FollowRedirect::FOLLOW_IS_NOT_A_BOOLEAN],
        ];
    }

    public function testCanGetAsBoolean()
    {
        $follow = true;
        $followRedirect = new FollowRedirect($follow);
        $this->assertSame($follow, $followRedirect->asBoolean());
    }
}
