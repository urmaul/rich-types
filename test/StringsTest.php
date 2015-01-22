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
    
    public function testLower()
    {
        $collection = Strings::from(['AB', 'Cd', 'ef'])->lower();
        $this->assertEquals(['ab', 'cd', 'ef'], $collection->value());
    }

    public function testTrim()
    {
        $collection = Strings::from(['a', ' b', 'c ', ' d '])->trim();
        $this->assertEquals(['a', 'b', 'c', 'd'], $collection->value());
    }

    public function testReplace()
    {
        $collection = Strings::from(['a%a', 'a%b%c'])->replace('%', '-');
        $this->assertEquals(['a-a', 'a-b-c'], $collection->value());
    }
}
