<?php
namespace DjThossi\SmokeTestingPhp;

class ResultCollection extends BaseCollection
{
    /**
     * @param Result $result
     */
    public function addResult(Result $result)
    {
        $this->elements[$result->getUrl()->asString()] = $result;
    }

    /**
     * @return Result[]
     */
    public function asArray()
    {
        return $this->elements;
    }
}
