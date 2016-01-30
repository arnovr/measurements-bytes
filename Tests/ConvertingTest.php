<?php


namespace Measurements\Bytes\Tests;


use Measurements\Bytes\Bytes;
use Measurements\Bytes\GigaBytes;
use Measurements\Bytes\KiloBytes;
use Measurements\Bytes\MegaBytes;
use Measurements\Bytes\TeraBytes;

class ConvertingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldConvertKiloBytesToBytes()
    {
        $kiloBytes = KiloBytes::allocateUnits(1);

        $this->assertEquals($kiloBytes->numberOfBytes(), 1 * 1024);
    }

    /**
     * @test
     */
    public function shouldConvertMegaBytesToBytes()
    {
        $megaBytes = MegaBytes::allocateUnits(1);

        $this->assertEquals($megaBytes->numberOfBytes(), 1 * 1024 * 1024);
    }

    /**
     * @test
     */
    public function shouldConvertGigaBytesToBytes()
    {
        $gigaBytes = GigaBytes::allocateUnits(1);

        $this->assertEquals($gigaBytes->numberOfBytes(), 1 * 1024 * 1024 * 1024);
    }

    /**
     * @test
     */
    public function shouldConvertTeraBytesToBytes()
    {
        $teraBytes = TeraBytes::allocateUnits(1);

        $this->assertEquals($teraBytes->numberOfBytes(), 1 * 1024 * 1024 * 1024 * 1024);
    }


    /**
     * @test
     */
    public function shouldConvertBytesToKiloBytes()
    {
        $bytes = Bytes::allocateUnits(1 * 1024);

        $this->assertEquals($bytes->kiloBytes()->units(), 1);
    }


    /**
     * @test
     */
    public function shouldConvertBytesToMegaBytes()
    {
        $bytes = Bytes::allocateUnits(1 * 1024 * 1024);

        $this->assertEquals($bytes->megaBytes()->units(), 1);
    }

    /**
     * @test
     */
    public function shouldConvertBytesToGigaBytes()
    {
        $bytes = Bytes::allocateUnits(1 * 1024 * 1024 * 1024);

        $this->assertEquals($bytes->gigaBytes()->units(), 1);
    }

    /**
     * @test
     */
    public function shouldConvertBytesToTeraBytes()
    {
        $bytes = Bytes::allocateUnits(1 * 1024 * 1024 * 1024 * 1024);

        $this->assertEquals($bytes->teraBytes()->units(), 1);
    }

    /**
     * @test
     */
    public function shouldConvertKiloBytesToMegaBytes()
    {
        $bytes = KiloBytes::allocateUnits(1 * 1024);

        $this->assertEquals($bytes->megaBytes()->units(), 1);
    }

    /**
     * @test
     */
    public function shouldConvertMegaBytesToGigaBytes()
    {
        $bytes = MegaBytes::allocateUnits(1 * 1024);

        $this->assertEquals($bytes->gigaBytes()->units(), 1);
    }

    /**
     * @test
     */
    public function shouldConvertGigaBytesToTeraBytes()
    {
        $bytes = GigaBytes::allocateUnits(1 * 1024);

        $this->assertEquals($bytes->teraBytes()->units(), 1);
    }

    /**
     * @test
     */
    public function shouldConvertMegaBytesToKiloBytes()
    {
        $bytes = MegaBytes::allocateUnits(1);

        $this->assertEquals($bytes->kiloBytes()->units(), 1 * 1024);
    }

    /**
     * @test
     */
    public function shouldConvertGigaBytesToMegaBytes()
    {
        $bytes = GigaBytes::allocateUnits(1);

        $this->assertEquals($bytes->megaBytes()->units(), 1 * 1024);
    }

    /**
     * @test
     */
    public function shouldConvertTeraBytesToGigaBytes()
    {
        $bytes = TeraBytes::allocateUnits(1);

        $this->assertEquals($bytes->gigaBytes()->units(), 1 * 1024);
    }
}
