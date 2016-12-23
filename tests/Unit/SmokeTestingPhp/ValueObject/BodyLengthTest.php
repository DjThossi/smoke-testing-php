<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\BodyLength
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsIntegerTrait
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsGreaterThanTrait
 */
class BodyLengthTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $BodyLength = new BodyLength(1337);
        $this->assertInstanceOf(BodyLength::class, $BodyLength);
    }

    public function testCanCreateInstanceWithLengthZero()
    {
        $BodyLength = new BodyLength(0);
        $this->assertInstanceOf(BodyLength::class, $BodyLength);
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $charsToPreserve
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($charsToPreserve, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $BodyLength = new BodyLength($charsToPreserve);
        $this->assertInstanceOf(BodyLength::class, $BodyLength);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'CharsToPreserve is String' => ['Hello World', InvalidValueException::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is Float' => [1.337, InvalidValueException::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is true' => [true, InvalidValueException::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is false' => [false, InvalidValueException::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is object' => [new stdClass(), InvalidValueException::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is empty' => ['', InvalidValueException::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is to small' => [-1, InvalidValueException::CHARS_TO_PRESERVE_IS_TOO_SMALL],
        ];
    }

    public function testCanAsInteger()
    {
        $charsToPreserve = 1337;
        $BodyLength = new BodyLength($charsToPreserve);
        $this->assertSame($charsToPreserve, $BodyLength->asInteger());
    }
}
