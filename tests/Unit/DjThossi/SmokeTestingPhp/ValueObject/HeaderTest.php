<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\Header;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Header
 */
class HeaderTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $header = new Header('key', 'value');
        $this->assertInstanceOf(Header::class, $header);
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $key
     * @param mixed $value
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($key, $value, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $header = new Header($key, $value);
        $this->assertInstanceOf(Header::class, $header);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'Key Integer' => [1337, '', Header::KEY_IS_NOT_A_STRING],
            'Key Float' => [1.337, '', Header::KEY_IS_NOT_A_STRING],
            'Key true' => [true, '', Header::KEY_IS_NOT_A_STRING],
            'Key false' => [false, '', Header::KEY_IS_NOT_A_STRING],
            'Key object' => [new stdClass(), '', Header::KEY_IS_NOT_A_STRING],
            'Key empty' => ['', '', Header::KEY_IS_EMPTY],
            'Value Integer' => ['key', 1337, Header::VALUE_IS_NOT_A_STRING],
            'Value Float' => ['key', 1.337, Header::VALUE_IS_NOT_A_STRING],
            'Value true' => ['key', true, Header::VALUE_IS_NOT_A_STRING],
            'Value false' => ['key', false, Header::VALUE_IS_NOT_A_STRING],
            'Value object' => ['key', new stdClass(), Header::VALUE_IS_NOT_A_STRING],
            'Value empty' => ['key', '', Header::VALUE_IS_EMPTY],
        ];
    }

    public function testCanGetKey()
    {
        $key = 'key';
        $header = new Header($key, 'value');
        $this->assertSame($key, $header->getKey());
    }

    public function testCanGetValue()
    {
        $value = 'value';
        $header = new Header('key', $value);
        $this->assertSame($value, $header->getValue());
    }
}
