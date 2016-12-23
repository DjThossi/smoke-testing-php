<?php
namespace Unit\DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Result;
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

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Result
     */
    private function getResultMock()
    {
        return $this->createMock(Result::class);
    }
}
