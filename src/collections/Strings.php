<?php

namespace rich\collections;

class Strings extends Variables
{
    /**
     * 
     * @param string $delimiter
     * @param string $string
     * @return static
     */
    public static function split($delimiter, $string)
    {
        $array = explode($delimiter, $string);
        return static::from($array);
    }
    
    
    /**
     * 
     * @return $this
     */
    public function lower()
    {
        return $this->map('strtolower');
    }
    
    /**
     * 
     * @return $this
     */
    public function trim()
    {
        return $this->map('trim');
    }
}
