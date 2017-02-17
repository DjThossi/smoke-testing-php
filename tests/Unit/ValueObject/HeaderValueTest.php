<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderValue;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\HeaderValue
 */
class HeaderValueTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $headerValue = new HeaderValue('HelloWorld');
        $this->assertInstanceOf(HeaderValue::class, $headerValue);
    }

    public function testCanCreateEmptyInstance()
    {
        $headerValue = new HeaderValue('');
        $this->assertInstanceOf(HeaderValue::class, $headerValue);
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $valueToTest
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($valueToTest, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $headerValue = new HeaderValue($valueToTest);
        $this->assertInstanceOf(HeaderValue::class, $headerValue);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'HeaderValue is Integer' => [1337, HeaderValue::VALUE_IS_NOT_A_STRING],
            'HeaderValue is Float' => [1.337, HeaderValue::VALUE_IS_NOT_A_STRING],
            'HeaderValue is true' => [true, HeaderValue::VALUE_IS_NOT_A_STRING],
            'HeaderValue is false' => [false, HeaderValue::VALUE_IS_NOT_A_STRING],
            'HeaderValue is object' => [new stdClass(), HeaderValue::VALUE_IS_NOT_A_STRING],
        ];
    }

    public function testCanGetAsString()
    {
        $value = 'HelloWorld2';
        $headerValue = new HeaderValue($value);
        $this->assertSame($value, $headerValue->asString());
    }
}
