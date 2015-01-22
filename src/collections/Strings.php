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
     * Makes a collection from a text with comma-separated strings
     * @param string $string
     * @return static
     */
    public static function splitList($string)
    {
        return static::split(',', $string)->trim();
    }
    
    
    /**
     * Make a string lowercase
     * @return $this
     * @see mb_strtolower()
     */
    public function lower()
    {
        return $this->map('mb_strtolower');
    }
    
    /**
     * Strip whitespace from the beginning and end of a string
     * @return $this
     * @see trim()
     */
    public function trim()
    {
        return $this->map('trim');
    }

    /**
     * Replace all occurrences of the search string with the replacement string
     * @param string|array $search
     * @param string|array $replace
     * @return $this
     * @see str_replace()
     */
    public function replace($search, $replace)
    {
        return $this->map(function ($str) use ($search, $replace) {
            return str_replace($search, $replace, $str);
        });
    }
}
