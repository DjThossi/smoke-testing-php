<?php
namespace DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\Result\Result;

class ResultCollection extends BaseCollection
{
    /**
     * @param Result $result
     */
    public function addResult(Result $result)
    {
        $this->addElement($result);
    }

    /**
     * @return Result
     */
    public function current()
    {
        return current($this->getElements());
    }

    /**
     * @return array
     */
    public function asDataProviderArray()
    {
        $retValue = [];
        /** @var Result $result */
        foreach ($this as $key => $result) {
            $key = sprintf('#%d: %s', $key, $result->getUrl()->asString());
            $retValue[$key] = [$result];
        }

        return $retValue;
    }
}
