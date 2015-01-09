<?php

namespace rich\collections;

class Variables
{
    /**
     * @var array
     */
    private $value = [];
    
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
     * 
     * @param callable $callback
     * @return $this
     */
    public function filter($callback = null)
    {
        $this->value = array_filter($this->value, $callback);
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
     * 
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }
}
