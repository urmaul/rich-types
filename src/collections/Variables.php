<?php

namespace rich\collections;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class Variables implements IteratorAggregate, Countable
{
    /**
     * @var array
     */
    private $value = [];
    
    /**
     * Returns the fully qualified name of this class.
     * @return string the fully qualified name of this class.
     */
    public static function className()
    {
        return get_called_class();
    }
    
    /**
     * @param $array
     * @return static
     */
    public static function from($array)
    {
        $object = new static();
        $object->value = $array;
        return $object;
    }
    

    /**
     * 
     * @param callable $callback
     * @return $this
     */
    public function map($callback)
    {
        $this->value = array_map($callback, $this->value);
        return $this;
    }

    /**
     * Maps values to keys using callback
     * @param callable $callback
     * @return static
     */
    public function mapKeys($callback)
    {
        $keys = array_map($callback, $this->value);
        $value = array_combine($keys, $this->value);
        return static::from($value);
    }
    
    /**
     * 
     * @param callable $callback
     * @return $this
     */
    public function filter($callback = null)
    {
        if ($callback !== null)
            $this->value = array_filter($this->value, $callback);
        else
            $this->value = array_filter($this->value);
        
        return $this;
    }
    
    /**
     * 
     * @return $this
     */
    public function unique()
    {
        $this->value = array_unique($this->value);
        return $this;
    }

    /**
     * Merges value with given array.
     * @param array $array
     * @return $this
     */
    public function merge($array)
    {
        $this->value = array_merge($this->value, $array);
        return $this;
    }
    
    /**
     * Finds an item by callback function.
     * @param callable $callback
     * @return mixed first item found or null if nothing match
     */
    public function find($callback)
    {
        foreach ($this->value as $value) {
            if (call_user_func($callback, $value)) {
                return $value;
            }
        }
        
        return null;
    }
    
    /**
     * Iteratively reduce the variables to a single valu
     * @see array_reduce()
     * @param callable $callback
     * @param mixed $initial
     * @return mixed resulting value.
     */
    public function reduce($callback, $initial = null)
    {
        return array_reduce($this->value, $callback, $initial);
    }
    
        
    /**
     * Returns values iterator
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->value);
    }
    
    /**
     * Returns values count
     * @return type
     */
    public function count()
    {
        return count($this->value);
    }

    
    /**
     * 
     * @return array
     */
    public function value()
    {
        return $this->value;
    }
    
    public function values()
    {
        return array_values($this->value);
    }
    
    
    /**
     * @return Numbers
     */
    public function asNumbers()
    {
        return Numbers::from($this->value);
    }
    
    /**
     * @return Objects
     */
    public function asObjects()
    {
        return Objects::from($this->value);
    }
    
    /**
     * @return Strings
     */
    public function asStrings()
    {
        return Strings::from($this->value);
    }
    
    /**
     * @return Variables
     */
    public function asVariables()
    {
        return Variables::from($this->value);
    }
}
