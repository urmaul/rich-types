<?php

use rich\collections\Variables;

class VariablesTest extends PHPUnit_Framework_TestCase
{
    public function testFrom()
    {
        $collection = Variables::from(['a', 'b', 'c']);
        $this->assertEquals(['a', 'b', 'c'], $collection->value());
    }

    public function testMerge()
    {
        $collection = Variables::from(['a', 'b'])
            ->merge(['c', 'd']);
        $this->assertEquals(['a', 'b', 'c', 'd'], $collection->value());
    }
}