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

class ShowProgressExampleTest extends PHPUnit_Framework_TestCase
{
    use SmokeTestTrait;

    public function successOutput(Result $result)
    {
        echo sprintf(
            "ok => %s \n",
            $result->getUrl()->asString()
        );
    }

    public function errorOutput(Result $result)
    {
        echo sprintf(
            "FAILED => %s \n",
            $result->getUrl()->asString()
        );
    }

    /**
     * @dataProvider myDataProvider
     *
     * @param Result $result
     */
    public function testExample(Result $result)
    {
        $this->assertSuccess($result);
        $this->assertTimeToFirstByteBelow(new TimeToFirstByte(2000), $result);
        $this->assertBodyNotEmpty($result);
    }

    /**
     * @return array
     */
    public function myDataProvider()
    {
        $urls = [
            'http://www.example.com',
            'http://www.example.com/',
        ];

        $options = new SmokeTestOptions(
            UrlCollection::fromStrings($urls),
            new RequestTimeout(1),
            new FollowRedirect(true),
            new Concurrency(10),
            new BodyLength(500),
            new BasicAuth('username', 'password')
        );

        return $this->runSmokeTests($options);
    }
}
