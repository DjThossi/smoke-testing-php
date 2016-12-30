<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\BodyLength
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
            'CharsToPreserve is String' => ['Hello World', BodyLength::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is Float' => [1.337, BodyLength::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is true' => [true, BodyLength::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is false' => [false, BodyLength::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is object' => [new stdClass(), BodyLength::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is empty' => ['', BodyLength::CHARS_TO_PRESERVE_IS_NOT_AN_INTEGER],
            'CharsToPreserve is to small' => [-1, BodyLength::CHARS_TO_PRESERVE_IS_TOO_SMALL],
        ];
    }

    public function testCanAsInteger()
    {
        $charsToPreserve = 1337;
        $BodyLength = new BodyLength($charsToPreserve);
        $this->assertSame($charsToPreserve, $BodyLength->asInteger());
    }
}
