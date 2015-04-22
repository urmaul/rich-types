<?php

namespace rich\collections;

class Arrays extends Variables
{
    public function column($columnKey, $indexKey = null)
    {
        $value = array_column($this->value(), $columnKey, $indexKey);
        return Variables::from($value);
    }

    public function indexByColumn($columnKey)
    {
        $keys = array_column($this->value(), $columnKey);
        $value = array_combine($keys, $this->values());
        return $this->setValue($value);
    }
}
