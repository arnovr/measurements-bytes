<?php

namespace Measurements\Bytes\Tests;

use Measurements\Bytes\Bytes;
use Measurements\Bytes\GigaBytes;
use Measurements\Bytes\InvalidUnitException;
use Measurements\Bytes\KiloBytes;
use Measurements\Bytes\MegaBytes;
use Measurements\Bytes\TeraBytes;

class BytesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testBytesEquals()
    {
        $bytes = Bytes::allocateUnits(10);

        $this->assertTrue(
            $bytes->equals(
                Bytes::allocateUnits(10)
            )
        );

        $this->assertFalse(
            $bytes->equals(
                Bytes::allocateUnits(11)
            )
        );

        $this->assertFalse(
            $bytes->equals(
                Bytes::allocateUnits(9)
            )
        );
    }

    /**
     * @test
     */
    public function testBytesLargerThan()
    {
        $bytes = Bytes::allocateUnits(10);

        $this->assertTrue(
            $bytes->largerThan(
                Bytes::allocateUnits(1)
            )
        );

        $this->assertFalse(
            $bytes->largerThan(
                Bytes::allocateUnits(11)
            )
        );

        $this->assertFalse(
            $bytes->largerThan(
                Bytes::allocateUnits(10)
            )
        );
    }

    /**
     * @test
     */
    public function testBytesLesserThan()
    {
        $bytes = Bytes::allocateUnits(10);

        $this->assertTrue(
            $bytes->lesserThan(
                Bytes::allocateUnits(11)
            )
        );

        $this->assertFalse(
            $bytes->lesserThan(
                Bytes::allocateUnits(1)
            )
        );

        $this->assertFalse(
            $bytes->lesserThan(
                Bytes::allocateUnits(10)
            )
        );
    }

    /**
     * @test
     */
    public function shouldGiveBytesWhenAllocating()
    {
        $units = 2;

        $bytes = KiloBytes::allocateUnits($units)->bytes();
        $this->assertEquals(
            $units,
            $bytes->kiloBytes()->units()
        );

        $bytes = MegaBytes::allocateUnits($units)->bytes();
        $this->assertEquals(
            $units,
            $bytes->megaBytes()->units()
        );

        $bytes = GigaBytes::allocateUnits($units)->bytes();
        $this->assertEquals(
            $units,
            $bytes->gigaBytes()->units()
        );

        $bytes = TeraBytes::allocateUnits($units)->bytes();
        $this->assertEquals(
            $units,
            $bytes->teraBytes()->units()
        );
    }
    /**
     * @test
     * @dataProvider incorrectDataTypes
     */
    public function shouldThrowExceptionOnIncorrectTypes($type)
    {
        $this->setExpectedException(InvalidUnitException::class);
        Bytes::allocateUnits($type);
    }

    public function incorrectDataTypes()
    {
        return [
            [''],
            [null],
            [false],
            [[]],
            [-1], // no negatives
            ['3443532523s'],
        ];
    }

    /**
     * @test
     */
    public function shouldCreateBytes()
    {
        $this->assertInstanceOf(
            Bytes::class,
            Bytes::allocateUnits(0)
        );

        $this->assertInstanceOf(
            Bytes::class,
            Bytes::allocateUnits(1)
        );

        $this->assertInstanceOf(
            Bytes::class,
            Bytes::allocateUnits(34358097329487)
        );
    }

    /**
     * @test
     */
    public function shouldBeTrueWhenZeroBytes()
    {
        $this->assertTrue(Bytes::allocateUnits(0)->hasZeroBytes());
        $this->assertTrue(KiloBytes::allocateUnits(0)->hasZeroBytes());
        $this->assertTrue(MegaBytes::allocateUnits(0)->hasZeroBytes());
        $this->assertTrue(GigaBytes::allocateUnits(0)->hasZeroBytes());
        $this->assertTrue(TeraBytes::allocateUnits(0)->hasZeroBytes());
    }

    /**
     * @test
     */
    public function shouldReturnNumberOfBytesWhenUnitIsCalledFromByteClass()
    {
        $bytes = Bytes::allocateUnits(1);
        $this->assertSame(1, $bytes->units());
    }
}