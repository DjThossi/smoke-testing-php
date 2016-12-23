<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsIntegerTrait
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsGreaterThanTrait
 */
class RequestTimeoutTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $RequestTimeout = new RequestTimeout(1337);
        $this->assertInstanceOf(RequestTimeout::class, $RequestTimeout);
    }

    public function testCanCreateInstanceWithLengthZero()
    {
        $RequestTimeout = new RequestTimeout(0);
        $this->assertInstanceOf(RequestTimeout::class, $RequestTimeout);
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $inSeconds
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($inSeconds, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $RequestTimeout = new RequestTimeout($inSeconds);
        $this->assertInstanceOf(RequestTimeout::class, $RequestTimeout);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'InSeconds is String' => ['Hello World', InvalidValueException::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is Float' => [1.337, InvalidValueException::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is true' => [true, InvalidValueException::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is false' => [false, InvalidValueException::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is object' => [new stdClass(), InvalidValueException::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is empty' => ['', InvalidValueException::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is to small' => [-1, InvalidValueException::IN_SECONDS_IS_TOO_SMALL],
        ];
    }

    public function testCanAsInteger()
    {
        $inSeconds = 1337;
        $RequestTimeout = new RequestTimeout($inSeconds);
        $this->assertSame($inSeconds, $RequestTimeout->inSeconds());
    }
}
