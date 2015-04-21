<?php

namespace rich\collections;

class Arrays extends Variables
{
    public function column($columnKey, $indexKey = null)
    {
        $value = array_column($this->value(), $columnKey, $indexKey);
        return Variables::from($value);
    }
}
