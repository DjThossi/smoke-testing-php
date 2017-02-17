<?php
namespace DjThossi\SmokeTestingPhp\Test\Unit\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\Body;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Body
 */
class BodyTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $body = new Body('HelloWorld');
        $this->assertInstanceOf(Body::class, $body);
    }

    public function testCanCreateEmptyInstance()
    {
        $body = new Body('');
        $this->assertInstanceOf(Body::class, $body);
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

        $body = new Body($valueToTest);
        $this->assertInstanceOf(Body::class, $body);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'Body is Integer' => [1337, Body::BODY_IS_NOT_A_STRING],
            'Body is Float' => [1.337, Body::BODY_IS_NOT_A_STRING],
            'Body is true' => [true, Body::BODY_IS_NOT_A_STRING],
            'Body is false' => [false, Body::BODY_IS_NOT_A_STRING],
            'Body is object' => [new stdClass(), Body::BODY_IS_NOT_A_STRING],
        ];
    }

    public function testCanGetAsString()
    {
        $bodyValue = 'HelloWorld2';
        $body = new Body($bodyValue);
        $this->assertSame($bodyValue, $body->asString());
    }
}
