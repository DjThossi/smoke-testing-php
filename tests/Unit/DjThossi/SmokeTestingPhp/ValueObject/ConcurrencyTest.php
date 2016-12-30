<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Concurrency
 */
class ConcurrencyTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $concurrency = new Concurrency(1337);
        $this->assertInstanceOf(Concurrency::class, $concurrency);
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

        $concurrency = new Concurrency($inSeconds);
        $this->assertInstanceOf(Concurrency::class, $concurrency);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'Concurrency is String' => ['Hello World', Concurrency::CONCURRENCY_IS_NOT_AN_INTEGER],
            'Concurrency is Float' => [1.337, Concurrency::CONCURRENCY_IS_NOT_AN_INTEGER],
            'Concurrency is true' => [true, Concurrency::CONCURRENCY_IS_NOT_AN_INTEGER],
            'Concurrency is false' => [false, Concurrency::CONCURRENCY_IS_NOT_AN_INTEGER],
            'Concurrency is object' => [new stdClass(), Concurrency::CONCURRENCY_IS_NOT_AN_INTEGER],
            'Concurrency is empty' => ['', Concurrency::CONCURRENCY_IS_NOT_AN_INTEGER],
            'Concurrency is to small' => [0, Concurrency::CONCURRENCY_IS_TOO_SMALL],
        ];
    }

    public function testCanGetAsInteger()
    {
        $value = 1337;
        $concurrency = new Concurrency($value);
        $this->assertSame($value, $concurrency->asInteger());
    }
}
