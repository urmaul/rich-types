<?php

namespace rich\collections;

class Arrays extends Variables
{
    /**
     * Returns the values from a single column of the array, identified by the column_key.
     * Optionally, you may provide an index_key to index the values in the returned array by the values from the
     * index_key column in the input array.
     * @param string $columnKey
     * @param string|null $indexKey
     * @return Variables
     */
    public function column($columnKey, $indexKey = null)
    {
        $value = array_column($this->value(), $columnKey, $indexKey);
        return Variables::from($value);
    }

    /**
     * Uses the values from a single column of the array as collection keys.
     * @param string $columnKey
     * @return $this
     */
    public function indexByColumn($columnKey)
    {
        $keys = array_column($this->value(), $columnKey);
        $value = array_combine($keys, $this->values());
        return $this->setValue($value);
    }
}
