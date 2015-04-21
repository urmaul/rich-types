<?php

namespace rich\test;

use rich\collections\Objects;
use rich\collections\Variables;

class ObjectsTest extends \PHPUnit_Framework_TestCase
{
    public function testProperty()
    {
        $collection = Objects::from([
            (object) ['foo' => 12, 'bar' => 34],
            (object) ['foo' => 56, 'bar' => 78],
        ]);
        $properties = $collection->property('bar');
        $this->assertInstanceOf(Variables::className(), $properties);
        $this->assertEquals([34, 78], $properties->value());
    }
}