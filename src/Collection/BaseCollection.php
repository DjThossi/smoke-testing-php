<?php
namespace DjThossi\SmokeTestingPhp\Collection;

use Countable;
use Iterator;

abstract class BaseCollection implements Iterator, Countable
{
    /**
     * @var array
     */
    private $elements = [];

    abstract public function current();

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->elements);
    }

    public function next()
    {
        next($this->elements);
    }

    public function rewind()
    {
        reset($this->elements);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return array_key_exists($this->key(), $this->elements);
    }

    /**
     * @return int
     */
    public function count()
    {
        return \count($this->elements);
    }

    /**
     * @return mixed
     */
    protected function getCurrent()
    {
        return current($this->elements);
    }

    /**
     * @param mixed $element
     */
    protected function addElement($element)
    {
        $this->elements[] = $element;
    }
}
