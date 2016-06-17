<?php

namespace rich\test;

use rich\collections\Variables;
use rich\collections\Strings;

class VariablesTest extends \PHPUnit_Framework_TestCase
{
    public function testFrom()
    {
        $collection = Variables::from(['a', 'b', 'c']);
        $this->assertEquals(['a', 'b', 'c'], $collection->value());
    }

    public function testMap()
    {
        $collection = Variables::from(['A', 'B', 'C'])->map('strtolower');
        $this->assertEquals(['a', 'b', 'c'], $collection->value());
    }
    
    public function indexByProvider()
    {
        return [
            [['A', 'B', 'C'], ['a' => 'A', 'b' => 'B', 'c' => 'C']],
            [[5 => 'A', 'B', 'foo' => 'C'], ['a' => 'A', 'b' => 'B', 'c' => 'C']],
        ];
    }

    /**
     * @dataProvider indexByProvider
     * @param $source
     * @param $expected
     */
    public function testIndexBy($source, $expected)
    {
        $collection = Variables::from($source)->indexBy('strtolower');
        $this->assertEquals($expected, $collection->value());
    }
    
    public function testMapKeysNotStrict()
    {
        $data = [
            'duck1' => 'Huey',
            'duck2' => 'Dewey',
            'duck3' => 'Louie',
        ];
        $map = [
            'duck1' => 'foo',
            'duck2' => 'bar',
        ];
        
        $expected = [
            'foo' => 'Huey',
            'bar' => 'Dewey',
            'duck3' => 'Louie',
        ];
        
        $actual = Variables::from($data)->mapKeys($map, false)->value();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @expectedException \rich\exceptions\UnexpectedKeyException
     */
    public function testMapKeysStrict()
    {
        $data = [
            'duck1' => 'Huey',
            'duck2' => 'Dewey',
            'duck3' => 'Louie',
        ];
        $map = [
            'duck1' => 'foo',
            'duck2' => 'bar',
        ];
        
        Variables::from($data)->mapKeys($map);
    }

    public function testFilter()
    {
        $collection = Variables::from(['a', '', 'b', 'c', ''])->filter();
        $this->assertEquals(['a', 'b', 'c'], $collection->values());
    }
    
    public function testDiff()
    {
        $collection = Variables::from([2, 6, 8, 10])->diff([6, 10, 15]);
        $this->assertEquals([0 => 2, 2 => 8], $collection->value());
    }

    public function testUnique()
    {
        $collection = Variables::from(['a', 'a', 'b', 'c', 'a'])->unique();
        $this->assertEquals(['a', 'b', 'c'], $collection->values());
    }

    public function testMerge()
    {
        $collection = Variables::from(['a', 'b'])
            ->merge(['c', 'd']);
        $this->assertEquals(['a', 'b', 'c', 'd'], $collection->value());
    }

    public function testFind()
    {
        $value = Variables::from([2, 6, 8])->find(function($item){
            return $item % 3 === 0;
        });
        $this->assertEquals(6, $value);
    }

    public function testReduce()
    {
        $value = Variables::from([2, 6, 8])->reduce(function($item, $total){
            return $total + $item;
        }, 0);
        $this->assertEquals(16, $value);
    }

    public function testIterator()
    {
        $collection = Variables::from(['a', 'b', 'c']);
        $this->assertInstanceOf('Iterator', $collection->getIterator());
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
        $this->assertInstanceOf(Strings::className(), $collection);
    }
}
