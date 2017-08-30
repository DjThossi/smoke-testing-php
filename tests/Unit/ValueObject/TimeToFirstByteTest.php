<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte
 */
class TimeToFirstByteTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $timeToFirstByte = new TimeToFirstByte(1337);
        $this->assertInstanceOf(TimeToFirstByte::class, $timeToFirstByte);
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

        $timeToFirstByte = new TimeToFirstByte($inMilliseconds);
        $this->assertInstanceOf(TimeToFirstByte::class, $timeToFirstByte);
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
        $timeToFirstByte = new TimeToFirstByte($inMilliseconds);
        $this->assertSame($inMilliseconds, $timeToFirstByte->inMilliSeconds());
    }
}
