<?php

namespace rich\collections;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use rich\exceptions\UnexpectedKeyException;

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
        $value = array_map($callback, $this->value);
        return $this->setValue($value);
    }

    /**
     * Maps values to keys using callback
     * @param callable $callback
     * @return static
     */
    public function indexBy($callback)
    {
        $keys = array_map($callback, $this->value);
        $value = array_combine($keys, $this->value);
        return $this->setValue($value);
    }
    
    /**
     * Replaces collection keys using map array.
     * @param array $replaces old keys to new keys map.
     * @param boolean $strict whether to throw exception when key is not in the map.
     * @return $this
     * @throws UnexpectedKeyException if strict and key is not in the map.
     */
    public function mapKeys(array $replaces, $strict = true)
    {
        $mapped = [];
        foreach ($this->value as $key => $value) {
            if (isset($replaces[$key])) {
                $newKey = $replaces[$key];
            } elseif ($strict) {
                throw new UnexpectedKeyException('Key "' . $key . '" not found in map.');
            } else {
                $newKey = $key;
            }
            
            $mapped[$newKey] = $value;
        }
        
        $this->value = $mapped;
        
        return $this;
    }
    
    /**
     * Performs `array_filter` to each item in collection.
     * @param callable $callback
     * @see array_filter()
     * @return $this
     */
    public function filter($callback = null)
    {
        if ($callback !== null)
            $value = array_filter($this->value, $callback);
        else
            $value = array_filter($this->value);

        return $this->setValue($value);
    }
    
    /**
     * Removes from collection all items that are present in $array.
     * @see array_diff()
     * @param array $array An array to compare against 
     * @return $this
     */
    public function diff($array)
    {
        $this->value = array_diff($this->value, $array);
        return $this;
    }
    
    /**
     * Performs `array_unique` to collection.
     * @see array_unique()
     * @return $this
     */
    public function unique()
    {
        $value = array_unique($this->value);
        return $this->setValue($value);
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
     * Returns it's value.
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
     * Iteratively reduce the variables to a single value.
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
     * Returns collection data preserving keys.
     * @return array
     */
    public function value()
    {
        return $this->value;
    }
    
    /**
     * Returns collection items as array indexed numerically.
     * @return array
     */
    public function values()
    {
        return array_values($this->value);
    }

    /**
     * Sets collection value.
     * @param array $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    
    /**
     * Converts collection to `Numbers`.
     * Can be used to clone collection.
     * @return Numbers
     */
    public function asNumbers()
    {
        return Numbers::from($this->value);
    }
    
    /**
     * Converts collection to `Objects`.
     * Can be used to clone collection.
     * @return Objects
     */
    public function asObjects()
    {
        return Objects::from($this->value);
    }
    
    /**
     * Converts collection to `Strings`.
     * Can be used to clone collection.
     * @return Strings
     */
    public function asStrings()
    {
        return Strings::from($this->value);
    }
    
    /**
     * Converts collection to `Variables`.
     * Can be used to clone collection.
     * @return Variables
     */
    public function asVariables()
    {
        return Variables::from($this->value);
    }
}
