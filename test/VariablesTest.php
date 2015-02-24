<?php

use rich\collections\Variables;
use rich\collections\Strings;

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
    
    public function testIterator()
    {
        $collection = Variables::from(['a', 'b', 'c']);
        $this->assertTrue($collection->getIterator() instanceof Iterator);
    }
    
    public function testForeach()
    {
        $vars = ['a' => 1, 'b' => 2, 'c' => 3];
        $collection = Variables::from($vars);
        foreach ($collection as $key => $val) {
            $this->assertArrayHasKey($key, $vars);
            $this->assertSame($vars[$key], $val);
        }
    }
    
    public function testCoubt()
    {
        $collection = Variables::from(['a', 'b', 'c']);
        $this->assertSame(3, count($collection));
    }
    
    public function testAsStrings()
    {
        $collection = Variables::from(['a', 'b', 'c'])->asStrings();
        $this->assertTrue($collection instanceof Strings);
    }
}