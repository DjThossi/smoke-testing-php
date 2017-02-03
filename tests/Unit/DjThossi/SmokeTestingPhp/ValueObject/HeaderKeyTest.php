<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\HeaderKey
 */
class HeaderKeyTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $headerKey = new HeaderKey('HelloWorld');
        $this->assertInstanceOf(HeaderKey::class, $headerKey);
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

        $headerKey = new HeaderKey($valueToTest);
        $this->assertInstanceOf(HeaderKey::class, $headerKey);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'HeaderKey is Integer' => [1337, HeaderKey::KEY_IS_NOT_A_STRING],
            'HeaderKey is Float' => [1.337, HeaderKey::KEY_IS_NOT_A_STRING],
            'HeaderKey is true' => [true, HeaderKey::KEY_IS_NOT_A_STRING],
            'HeaderKey is false' => [false, HeaderKey::KEY_IS_NOT_A_STRING],
            'HeaderKey is object' => [new stdClass(), HeaderKey::KEY_IS_NOT_A_STRING],
            'HeaderKey is empty' => ['', HeaderKey::KEY_IS_EMPTY],
        ];
    }

    public function testCanGetAsString()
    {
        $key = 'HelloWorld2';
        $headerKey = new HeaderKey($key);
        $this->assertSame($key, $headerKey->asString());
    }
}
