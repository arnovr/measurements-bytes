<?php


namespace Measurements\Bytes\Tests;


use Measurements\Bytes\AbleToConvertToBytes;
use Measurements\Bytes\Bytes;
use Measurements\Bytes\GigaBytes;
use Measurements\Bytes\KiloBytes;
use Measurements\Bytes\MegaBytes;
use Measurements\Bytes\TeraBytes;

class ByteSubtractingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider listOfSubtractingUnits
     * @param Bytes $unit1
     * @param Bytes $unit2
     * @param Bytes $expected
     */
    public function shouldBeSubtracted(Bytes $unit1, Bytes $unit2, Bytes $expected)
    {
        $actual = $unit1->subtract($unit2);
        $this->assertEquals(
            $expected->numberOfBytes(),
            $actual->numberOfBytes()
        );
    }


    public function listOfSubtractingUnits()
    {
        return [
            [ KiloBytes::allocateUnits(2), KiloBytes::allocateUnits(1), KiloBytes::allocateUnits(1) ],
            [ MegaBytes::allocateUnits(2), MegaBytes::allocateUnits(1), MegaBytes::allocateUnits(1) ],
            [ GigaBytes::allocateUnits(2), GigaBytes::allocateUnits(1), GigaBytes::allocateUnits(1) ],
            [ TeraBytes::allocateUnits(2), TeraBytes::allocateUnits(1), TeraBytes::allocateUnits(1) ],
            [ KiloBytes::allocateUnits(1), Bytes::allocateUnits(2), Bytes::allocateUnits(1022) ],
            [ MegaBytes::allocateUnits(1), KiloBytes::allocateUnits(2), KiloBytes::allocateUnits(1022) ],
            [ GigaBytes::allocateUnits(1), MegaBytes::allocateUnits(2), MegaBytes::allocateUnits(1022) ],
            [ TeraBytes::allocateUnits(1), GigaBytes::allocateUnits(2), GigaBytes::allocateUnits(1022) ],
        ];
    }
}