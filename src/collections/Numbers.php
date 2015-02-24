<?php

namespace rich\collections;

class Numbers extends Variables
{
    public function sum()
    {
        return array_sum($this->value());
    }
}