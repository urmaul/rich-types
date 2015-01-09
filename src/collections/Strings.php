<?php

namespace rich\collections;

class Strings extends Variables
{
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
