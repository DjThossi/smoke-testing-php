<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\Ensure\InvalidValueException;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\BasicAuth
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsStringTrait
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Ensure\EnsureIsNotEmptyTrait
 */
class BasicAuthTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $basicAuth = new BasicAuth('username', 'password');
        $this->assertInstanceOf(BasicAuth::class, $basicAuth);
    }

    public function testCanCreateInstanceWithEmptyPassword()
    {
        $basicAuth = new BasicAuth('username', '');
        $this->assertInstanceOf(BasicAuth::class, $basicAuth);
    }

    /**
     * @dataProvider failingValuesProvider
     *
     * @param mixed $username
     * @param mixed $password
     * @param int $exceptionCode
     */
    public function testCreateInstanceFailing($username, $password, $exceptionCode)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionCode($exceptionCode);

        $basicAuth = new BasicAuth($username, $password);
        $this->assertInstanceOf(BasicAuth::class, $basicAuth);
    }

    public function failingValuesProvider()
    {
        return [
            'Username Integer' => [1337, '', InvalidValueException::USERNAME_IS_NOT_A_STRING],
            'Username Float' => [1.337, '', InvalidValueException::USERNAME_IS_NOT_A_STRING],
            'Username true' => [true, '', InvalidValueException::USERNAME_IS_NOT_A_STRING],
            'Username false' => [false, '', InvalidValueException::USERNAME_IS_NOT_A_STRING],
            'Username object' => [new stdClass(), '', InvalidValueException::USERNAME_IS_NOT_A_STRING],
            'Username empty' => ['', '', InvalidValueException::USERNAME_IS_EMPTY],
            'Password Integer' => ['username', 1337, InvalidValueException::PASSWORD_IS_NOT_A_STRING],
            'Password Float' => ['username', 1.337, InvalidValueException::PASSWORD_IS_NOT_A_STRING],
            'Password true' => ['username', true, InvalidValueException::PASSWORD_IS_NOT_A_STRING],
            'Password false' => ['username', false, InvalidValueException::PASSWORD_IS_NOT_A_STRING],
            'Password object' => ['username', new stdClass(), InvalidValueException::PASSWORD_IS_NOT_A_STRING],
        ];
    }

    public function testCanGetUsername()
    {
        $username = 'username';
        $basicAuth = new BasicAuth($username, 'password');
        $this->assertSame($username, $basicAuth->getUsername());
    }

    public function testCanGetPassword()
    {
        $password = 'password';
        $basicAuth = new BasicAuth('username', $password);
        $this->assertSame($password, $basicAuth->getPassword());
    }
}
