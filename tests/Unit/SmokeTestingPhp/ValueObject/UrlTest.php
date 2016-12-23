<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\Url;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Url
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsStringTrait
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsUrlTrait
 */
class UrlTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $url = new Url('http://www.sebastianthoss.de');
        $this->assertInstanceOf(Url::class, $url);
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

        $url = new Url($valueToTest);
        $this->assertInstanceOf(Url::class, $url);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'Url is Integer' => [1337, InvalidValueException::URL_IS_NOT_A_STRING],
            'Url is Float' => [1.337, InvalidValueException::URL_IS_NOT_A_STRING],
            'Url is true' => [true, InvalidValueException::URL_IS_NOT_A_STRING],
            'Url is false' => [false, InvalidValueException::URL_IS_NOT_A_STRING],
            'Url is object' => [new stdClass(), InvalidValueException::URL_IS_NOT_A_STRING],
            'Url is empty' => ['', InvalidValueException::URL_IS_NOT_A_URL],
            'Url is String' => ['username', InvalidValueException::URL_IS_NOT_A_URL],
        ];
    }

    public function testCanGetAsString()
    {
        $urlValue = 'http://www.sebastianthoss.de';
        $url = new Url($urlValue);
        $this->assertSame($urlValue, $url->asString());
    }
}
