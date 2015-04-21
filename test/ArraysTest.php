<?php

namespace rich\test;

use rich\collections\Arrays;
use rich\collections\Variables;

class ArraysTest extends \PHPUnit_Framework_TestCase
{
    public function testColumn()
    {
        $collection = Arrays::from([
            ['foo' => 12, 'bar' => 34],
            ['foo' => 56, 'bar' => 78],
        ]);
        $properties = $collection->column('bar');
        $this->assertInstanceOf(Variables::className(), $properties);
        $this->assertEquals([34, 78], $properties->value());
    }

    public function testColumnIndex()
    {
        $collection = Arrays::from([
            ['foo' => 12, 'bar' => 34],
            ['foo' => 56, 'bar' => 78],
        ]);
        $properties = $collection->column('bar', 'foo');
        $this->assertInstanceOf(Variables::className(), $properties);
        $this->assertEquals([12 => 34, 56 => 78], $properties->value());
    }
}