<?php
namespace Unit\DjThossi\SmokeTestingPhp\ValueObject;

use DjThossi\SmokeTestingPhp\ValueObject\Header;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderValue;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\ValueObject\Header
 */
class HeaderTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $header = new Header($this->getHeaderKeyMock(), $this->getHeaderValueMock());
        $this->assertInstanceOf(Header::class, $header);
    }

    public function testCanCreateFromPrimitives()
    {
        $key = 'key';
        $value = 'value';
        $header = Header::fromPrimitives($key, $value);
        $this->assertSame($key, $header->getKey()->asString());
        $this->assertSame($value, $header->getValue()->asString());
    }

    public function testCanGetKey()
    {
        $key = $this->getHeaderKeyMock();
        $header = new Header($key, $this->getHeaderValueMock());
        $this->assertSame($key, $header->getKey());
    }

    public function testCanGetValue()
    {
        $value = $this->getHeaderValueMock();
        $header = new Header($this->getHeaderKeyMock(), $value);
        $this->assertSame($value, $header->getValue());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|HeaderKey
     */
    private function getHeaderKeyMock()
    {
        return $this->createMock(HeaderKey::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|HeaderValue
     */
    private function getHeaderValueMock()
    {
        return $this->createMock(HeaderValue::class);
    }
}
