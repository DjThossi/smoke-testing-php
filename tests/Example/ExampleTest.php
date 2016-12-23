<?php
namespace DjThossi\SmokeTestingPhp;

use DjThossi\SmokeTestingPhp\ValueObject\BasicAuth;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use PHPUnit_Framework_TestCase;

class ExampleTest extends PHPUnit_Framework_TestCase
{
    use SmokeTrait;

    /**
     * @dataProvider myDataProvider
     *
     * @param Result $result
     */
    public function testExample(Result $result)
    {
        $this->assertSuccess($result);
        $this->assertTimeToFirstByteBelow(new ResponseTimeout(200), $result);
        $this->assertBodyNotEmpty($result);
    }

    /**
     * @return ResultCollection
     */
    public function myDataProvider()
    {
        $options = new SmokeTestOptions(
            UrlCollection::fromFile(__DIR__ . '/../../data/urls.txt'),
            new Concurrency(10),
            new FollowRedirect(true),
            new RequestTimeout(2),
            new BodyLength(500),
            new BasicAuth('username', 'password')
        );

        return $this->runSmokeTests($options);
    }
}
