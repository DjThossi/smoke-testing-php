<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect
 * @covers \DjThossi\SmokeTestingPhp\Ensure\EnsureIsBooleanTrait
 */
class FollowRedirectTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstanceTrue()
    {
        $FollowRedirect = new FollowRedirect(true);
        $this->assertInstanceOf(FollowRedirect::class, $FollowRedirect);
    }

    public function testCanCreateInstanceFalse()
    {
        $FollowRedirect = new FollowRedirect(false);
        $this->assertInstanceOf(FollowRedirect::class, $FollowRedirect);
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

        $FollowRedirect = new FollowRedirect($follow);
        $this->assertInstanceOf(FollowRedirect::class, $FollowRedirect);
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
        $FollowRedirect = new FollowRedirect($follow);
        $this->assertSame($follow, $FollowRedirect->asBoolean());
    }
}
