<?php

namespace rich\collections;

class Objects extends Variables
{
    public function property($property)
    {
        return $this->asVariables()->map(function($object) use ($property) {
            return $object->$property;
        });
    }
}