<?php
namespace DjThossi\SmokeTestingPhp;

use Countable;
use Iterator;

abstract class BaseCollection implements Iterator, Countable
{
    /**
     * @var array
     */
    protected $elements = [];

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
     * @return mixed
     */
    public function current()
    {
        return current($this->elements);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }
}
