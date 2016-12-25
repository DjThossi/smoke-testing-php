<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte
 * @covers \DjThossi\SmokeTestingPhp\Ensure\EnsureIsIntegerTrait
 * @covers \DjThossi\SmokeTestingPhp\Ensure\EnsureIsGreaterThanTrait
 */
class TimeToFirstByteTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $TimeToFirstByte = new TimeToFirstByte(1337);
        $this->assertInstanceOf(TimeToFirstByte::class, $TimeToFirstByte);
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $inMilliseconds
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($inMilliseconds, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $TimeToFirstByte = new TimeToFirstByte($inMilliseconds);
        $this->assertInstanceOf(TimeToFirstByte::class, $TimeToFirstByte);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'InMilliseconds is String' => ['Hello World', TimeToFirstByte::IN_MILLISECONDS_IS_NOT_AN_INTEGER],
            'InMilliseconds is Float' => [1.337, TimeToFirstByte::IN_MILLISECONDS_IS_NOT_AN_INTEGER],
            'InMilliseconds is true' => [true, TimeToFirstByte::IN_MILLISECONDS_IS_NOT_AN_INTEGER],
            'InMilliseconds is false' => [false, TimeToFirstByte::IN_MILLISECONDS_IS_NOT_AN_INTEGER],
            'InMilliseconds is object' => [new stdClass(), TimeToFirstByte::IN_MILLISECONDS_IS_NOT_AN_INTEGER],
            'InMilliseconds is empty' => ['', TimeToFirstByte::IN_MILLISECONDS_IS_NOT_AN_INTEGER],
            'InMilliseconds is to small' => [0, TimeToFirstByte::IN_MILLISECONDS_IS_TOO_SMALL],
        ];
    }

    public function testCanGetInMilliseconds()
    {
        $inMilliseconds = 1337;
        $TimeToFirstByte = new TimeToFirstByte($inMilliseconds);
        $this->assertSame($inMilliseconds, $TimeToFirstByte->inMilliSeconds());
    }
}
