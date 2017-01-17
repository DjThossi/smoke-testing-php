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
}
