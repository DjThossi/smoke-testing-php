<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout
 */
class RequestTimeoutTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $requestTimeout = new RequestTimeout(1337);
        $this->assertInstanceOf(RequestTimeout::class, $requestTimeout);
    }

    public function testCanCreateInstanceWithLengthZero()
    {
        $requestTimeout = new RequestTimeout(0);
        $this->assertInstanceOf(RequestTimeout::class, $requestTimeout);
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

        $requestTimeout = new RequestTimeout($inSeconds);
        $this->assertInstanceOf(RequestTimeout::class, $requestTimeout);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'InSeconds is String' => ['Hello World', RequestTimeout::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is Float' => [1.337, RequestTimeout::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is true' => [true, RequestTimeout::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is false' => [false, RequestTimeout::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is object' => [new stdClass(), RequestTimeout::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is empty' => ['', RequestTimeout::IN_SECONDS_IS_NOT_AN_INTEGER],
            'InSeconds is to small' => [-1, RequestTimeout::IN_SECONDS_IS_TOO_SMALL],
        ];
    }

    public function testCanGetInSeconds()
    {
        $inSeconds = 1337;
        $requestTimeout = new RequestTimeout($inSeconds);
        $this->assertSame($inSeconds, $requestTimeout->inSeconds());
    }
}
