<?php
namespace Example\DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\Collection\UrlCollection;
use DjThossi\SmokeTestingPhp\Options\SmokeTestOptions;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\SmokeTestTrait;
use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use DjThossi\SmokeTestingPhp\ValueObject\FollowRedirect;
use DjThossi\SmokeTestingPhp\ValueObject\RequestTimeout;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use PHPUnit_Framework_TestCase;

class FileExampleTest extends PHPUnit_Framework_TestCase
{
    use SmokeTestTrait;

    /**
     * @dataProvider myDataProvider
     *
     * @param Result $result
     */
    public function testExample(Result $result)
    {
        $this->assertSuccess($result);
        $this->assertTimeToFirstByteBelow(new TimeToFirstByte(200), $result);
        $this->assertBodyNotEmpty($result);
    }

    /**
     * @return array
     */
    public function myDataProvider()
    {
        $options = new SmokeTestOptions(
            UrlCollection::fromFile(__DIR__ . '/data/urls.txt'),
            new RequestTimeout(2),
            new FollowRedirect(true),
            new Concurrency(10),
            new BodyLength(500),
            new BasicAuth('username', 'password')
        );

        return $this->runSmokeTests($options);
    }
}
