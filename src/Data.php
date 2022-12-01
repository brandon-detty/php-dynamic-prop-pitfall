<?php

namespace BrandonDetty\DynamicPropPitfall;

abstract class Data implements \ArrayAccess, \Iterator, \Countable
{
    protected static array $prop_names;
    protected static int $prop_count;

    private int $iterator_pos = 0;

    final protected static function initializeClassProperties()
    {
        $reflection = new \ReflectionClass(static::class);
        $public_props = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
        static::$prop_names = array_column($public_props, 'name');
        static::$prop_count = count($public_props);
    }

    //
    // ArrayAccess interface
    //

    final public function offsetSet(mixed $prop, mixed $value): void
    {
        if (!property_exists($this, $prop)) {
            throw new \Error('undefined property');
        }
        $this->$prop = $value;
    }

    public function offsetExists(mixed $prop): bool
    {
        return property_exists($this, $prop);
    }

    public function offsetUnset(mixed $prop): void
    {
        if (property_exists($this, $prop)) {
            unset($this->$prop);
        }
    }

    public function offsetGet(mixed $prop): mixed
    {
        if (!property_exists($this, $prop)) {
            throw new \Error('undefined property');
        }
        return $this->$prop;
    }

    //
    // Iterator interface
    //

    public function rewind(): void
    {
        $this->iterator_pos = 0;
        if (!isset(static::$prop_names)) {
            static::initializeClassProperties();
        }
    }

    public function current(): mixed
    {
        return $this->{static::$prop_names[$this->iterator_pos]};
    }

    public function key(): mixed
    {
        return static::$prop_names[$this->iterator_pos];
    }

    public function next(): void
    {
        ++$this->iterator_pos;
    }

    public function valid(): bool
    {
        return $this->iterator_pos < static::$prop_count;
    }

    //
    // Countable interface
    //

    public static function count(): void
    {
        if (!isset(static::$prop_count)) {
            static::initializeClassProperties();
        }
        return static::$prop_count;
    }
}
