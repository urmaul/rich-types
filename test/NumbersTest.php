<?php

use rich\collections\Numbers;

class NumbersTest extends PHPUnit_Framework_TestCase
{
    public function testSum()
    {
        $collection = Numbers::from([10, 20, 5.4]);
        $this->assertEquals(35.4, $collection->sum());
    }
}