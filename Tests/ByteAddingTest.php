<?php

namespace Measurements\Bytes\Tests;

use Measurements\Bytes\Bytes;
use Measurements\Bytes\GigaBytes;
use Measurements\Bytes\KiloBytes;
use Measurements\Bytes\MegaBytes;
use Measurements\Bytes\TeraBytes;

class ByteAddingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider listOfAddingUnits
     * @param Bytes $unit1
     * @param Bytes $unit2
     * @param Bytes $expected
     */
    public function shouldBeAdded(Bytes $unit1, Bytes $unit2, Bytes $expected)
    {
        $actual = $unit1->add($unit2);
        $this->assertEquals(
            $expected->numberOfBytes(),
            $actual->numberOfBytes()
        );
    }


    public function listOfAddingUnits()
    {
        return [
            [KiloBytes::allocateUnits(1), KiloBytes::allocateUnits(1), KiloBytes::allocateUnits(2)],
            [MegaBytes::allocateUnits(1), MegaBytes::allocateUnits(1), MegaBytes::allocateUnits(2)],
            [GigaBytes::allocateUnits(1), GigaBytes::allocateUnits(1), GigaBytes::allocateUnits(2)],
            [TeraBytes::allocateUnits(1), TeraBytes::allocateUnits(1), TeraBytes::allocateUnits(2)],
            [Bytes::allocateUnits(1), KiloBytes::allocateUnits(1), Bytes::allocateUnits(1025)],
            [KiloBytes::allocateUnits(1), MegaBytes::allocateUnits(1), KiloBytes::allocateUnits(1025)],
            [MegaBytes::allocateUnits(1), GigaBytes::allocateUnits(1), MegaBytes::allocateUnits(1025)],
            [GigaBytes::allocateUnits(1), TeraBytes::allocateUnits(1), GigaBytes::allocateUnits(1025)],
        ];
    }
}