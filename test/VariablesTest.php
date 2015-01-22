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

    public function testUnique()
    {
        $collection = Variables::from(['a', 'a', 'b', 'c', 'a'])->unique();
        $this->assertEquals(['a', 'b', 'c'], $collection->values());
    }

    public function testFilter()
    {
        $collection = Variables::from(['a', '', 'b', 'c', ''])->filter();
        $this->assertEquals(['a', 'b', 'c'], $collection->values());
    }
}