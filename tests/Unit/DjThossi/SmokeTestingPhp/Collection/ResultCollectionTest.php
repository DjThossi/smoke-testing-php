<?php
namespace Unit\DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Result\Result;
use DjThossi\SmokeTestingPhp\ValueObject\Url;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \DjThossi\SmokeTestingPhp\Collection\ResultCollection
 * @covers \DjThossi\SmokeTestingPhp\Collection\BaseCollection
 */
class ResultCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testIsCreatedEmpty()
    {
        $collection = new ResultCollection();

        $this->assertInstanceOf(ResultCollection::class, $collection);
        $this->assertCount(0, $collection);
    }

    public function testCanAddToCollection()
    {
        $result1 = $this->getResultMock();
        $result2 = $this->getResultMock();

        $collection = new ResultCollection();
        $collection->addResult($result1);
        $collection->addResult($result2);

        $this->assertCount(2, $collection);
    }

    public function testIteration()
    {
        $results = [
            $this->getResultMock(),
            $this->getResultMock(),
        ];

        $collection = new ResultCollection();
        $collection->addResult($results[0]);
        $collection->addResult($results[1]);

        /** @var Result $result */
        foreach ($collection as $key => $result) {
            $this->assertSame($results[$key], $result);
        }
    }

    public function testAs()
    {
        $url1 = $this->getUrlMock();
        $url1->expects($this->once())
            ->method('asString')
            ->willReturn('url1');

        $url2 = $this->getUrlMock();
        $url2->expects($this->once())
            ->method('asString')
            ->willReturn('url2');

        $result1 = $this->getResultMock();
        $result1->expects($this->once())
            ->method('getUrl')
            ->willReturn($url1);

        $result2 = $this->getResultMock();
        $result2->expects($this->once())
            ->method('getUrl')
            ->willReturn($url2);

        $results = [
            '#0: url1' => [$result1],
            '#1: url2' => [$result2],
        ];

        $collection = new ResultCollection();
        $collection->addResult($result1);
        $collection->addResult($result2);

        $this->assertEquals($results, $collection->asDataProviderArray());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Result
     */
    private function getResultMock()
    {
        return $this->createMock(Result::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Url
     */
    private function getUrlMock()
    {
        return $this->createMock(Url::class);
    }
}
