<?php

namespace rich\test;

use rich\collections\Arrays;
use rich\collections\Variables;

class ArraysTest extends \PHPUnit_Framework_TestCase
{
    public function columnProvider()
    {
        $source = [
            ['foo' => 12, 'bar' => 34],
            ['foo' => 56, 'bar' => 78],
        ];

        return [
            [$source, 'bar', null, [34, 78]],
            [$source, 'bar', 'foo', [12 => 34, 56 => 78]],
        ];
    }

    /**
     * @dataProvider columnProvider
     */
    public function testColumn($source, $columnKey, $indexKey, $expected)
    {
        $collection = Arrays::from($source);
        $properties = $collection->column($columnKey, $indexKey);
        $this->assertInstanceOf(Variables::className(), $properties);
        $this->assertEquals($expected, $properties->value());
    }

    public function indexByColumnProvider()
    {
        $v1 = ['foo' => 12, 'bar' => 34];
        $v2 = ['foo' => 56, 'bar' => 78];

        return [
            [[$v1, $v2], 'foo', [12 => $v1, 56 => $v2]],
            [['a' => $v1, 10 => $v2], 'foo', [12 => $v1, 56 => $v2]],
        ];
    }

    /**
     * @dataProvider indexByColumnProvider
     */
    public function testIndexByColumn($source, $columnKey, $expected)
    {
        $collection = Arrays::from($source)->indexByColumn($columnKey);
        $this->assertEquals($expected, $collection->value());
    }
}