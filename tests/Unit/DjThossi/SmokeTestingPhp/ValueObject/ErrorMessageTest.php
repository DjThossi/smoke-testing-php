<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\Ensure\InvalidValueException;
use DjThossi\SmokeTestingPhp\ValueObject\ErrorMessage;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\ErrorMessage
 */
class ErrorMessageTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $errorMessage = new ErrorMessage('HelloWorld');
        $this->assertInstanceOf(ErrorMessage::class, $errorMessage);
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

        $errorMessage = new ErrorMessage($valueToTest);
        $this->assertInstanceOf(ErrorMessage::class, $errorMessage);
    }

    /**
     * @return array
     */
    public function failingValuesProvider()
    {
        return [
            'Message is Integer' => [1337, ErrorMessage::MESSAGE_IS_NOT_A_STRING],
            'Message is Float' => [1.337, ErrorMessage::MESSAGE_IS_NOT_A_STRING],
            'Message is true' => [true, ErrorMessage::MESSAGE_IS_NOT_A_STRING],
            'Message is false' => [false, ErrorMessage::MESSAGE_IS_NOT_A_STRING],
            'Message is object' => [new stdClass(), ErrorMessage::MESSAGE_IS_NOT_A_STRING],
            'Message is empty' => ['', ErrorMessage::MESSAGE_IS_EMPTY],
        ];
    }

    public function testCanGetAsString()
    {
        $message = 'HelloWorld2';
        $errorMessage = new ErrorMessage($message);
        $this->assertSame($message, $errorMessage->asString());
    }
}
