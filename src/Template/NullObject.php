<?php

namespace Flex\Template;

/**
 * Class NullObject
 * @package Flex\Template
 *
 * Acts like a blackhole, all action is null
 */
class NullObject implements \ArrayAccess, \IteratorAggregate, \Serializable, \Countable
{
    /**
     * @inheritdoc
     * @return null
     */
    public function __get($name)
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function __set($name, $value)
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function __set_state()
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function __call($name, $arguments)
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    static public function __callStatic($name, $arguments)
    {
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function __toString()
    {
        return '';
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function __invoke()
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function offsetSet($key, $value)
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function offsetGet($key)
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function offsetExists($key)
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function offsetUnset($key)
    {
    }

    /**
     * @inheritdoc
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this);
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function serialize()
    {
        return null;
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function unserialize($data)
    {
    }

    /**
     * @inheritdoc
     * @return null
     */
    public function count()
    {
        return null;
    }
}