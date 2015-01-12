<?php

use rich\collections\Strings;

class StringsTest extends PHPUnit_Framework_TestCase
{
    public function testFrom()
    {
        $collection = Strings::from(['a', 'b', 'c']);
        $this->assertEquals(['a', 'b', 'c'], $collection->value());
    }
    
    public function testSplit()
    {
        $collection = Strings::split(',', 'a,b,c');
        $this->assertEquals(['a', 'b', 'c'], $collection->value());
    }
    
    public function testSplitList()
    {
        $collection = Strings::splitList("a,b, c,\nd, \r\ne");
        $this->assertEquals(['a', 'b', 'c', 'd', 'e'], $collection->value());
    }
    
    public function testTrim()
    {
        $collection = Strings::from(['a', ' b', 'c ', ' d '])->trim();
        $this->assertEquals(['a', 'b', 'c', 'd'], $collection->value());
    }
    
    public function testUnique()
    {
        $collection = Strings::from(['a', 'a', 'b', 'c', 'a'])->unique();
        $this->assertEquals(['a', 'b', 'c'], $collection->values());
    }
    
    public function testFilter()
    {
        $collection = Strings::from(['a', '', 'b', 'c', ''])->filter();
        $this->assertEquals(['a', 'b', 'c'], $collection->values());
    }
}
