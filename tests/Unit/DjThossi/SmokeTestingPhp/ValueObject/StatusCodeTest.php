<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\StatusCode;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\StatusCode
 */
class StatusCodeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider workingValuesProvider
     *
     * @param int $code
     */
    public function testCanCreateInstance($code)
    {
        $statusCode = new StatusCode($code);
        $this->assertInstanceOf(StatusCode::class, $statusCode);
    }

    public function workingValuesProvider()
    {
        return [
            '100' => [100],
            '200' => [200],
            '599' => [511],
        ];
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $code
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($code, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $statusCode = new StatusCode($code);
        $this->assertInstanceOf(StatusCode::class, $statusCode);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'StatusCode is String' => ['Hello World', StatusCode::STATUS_CODE_IS_NOT_AN_INTEGER],
            'StatusCode is Float' => [1.337, StatusCode::STATUS_CODE_IS_NOT_AN_INTEGER],
            'StatusCode is true' => [true, StatusCode::STATUS_CODE_IS_NOT_AN_INTEGER],
            'StatusCode is false' => [false, StatusCode::STATUS_CODE_IS_NOT_AN_INTEGER],
            'StatusCode is object' => [new stdClass(), StatusCode::STATUS_CODE_IS_NOT_AN_INTEGER],
            'StatusCode is empty' => ['', StatusCode::STATUS_CODE_IS_NOT_AN_INTEGER],
            'StatusCode is to small' => [99, StatusCode::STATUS_CODE_IS_TOO_SMALL],
            'StatusCode is to big' => [512, StatusCode::STATUS_CODE_IS_TOO_BIG],
        ];
    }

    public function testCanAsInteger()
    {
        $code = 404;
        $statusCode = new StatusCode($code);
        $this->assertSame($code, $statusCode->asInteger());
    }
}
