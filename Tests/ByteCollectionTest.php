<?php


namespace Measurements\Bytes\Tests;


use Measurements\Bytes\ByteCollection;
use Measurements\Bytes\Bytes;
use Measurements\Bytes\GigaBytes;
use Measurements\Bytes\KiloBytes;
use Measurements\Bytes\MegaBytes;
use Measurements\Bytes\TeraBytes;

class ByteCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGiveTheTotalBytesInTheCollection()
    {
        $actual = TeraBytes::allocateUnits(1)->bytes()->add(
            GigaBytes::allocateUnits(1)->bytes()->add(
                MegaBytes::allocateUnits(1)->bytes()->add(
                    KiloBytes::allocateUnits(1)->bytes()->add(
                        Bytes::allocateUnits(1)
                    )
                )
            )
        );

        $expected = $this->createCollection(
            [
                TeraBytes::allocateUnits(1),
                GigaBytes::allocateUnits(1),
                MegaBytes::allocateUnits(1),
                KiloBytes::allocateUnits(1),
                Bytes::allocateUnits(1)
            ]
        );

        $this->assertEquals(
            $expected->bytes(),
            $actual
        );
    }

    /**
     * @test
     */
    public function shouldCreateACollectionWithGigabyteAndBytes()
    {
        $actual = ByteCollection::allocateBytes(
            GigaBytes::allocateUnits(1)->add(
                Bytes::allocateUnits(1)->bytes()
            )->bytes()
        );

        $expected = $this->createCollection([ GigaBytes::allocateUnits(1), Bytes::allocateUnits(1) ]);

        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @test
     */
    public function shouldCreateACollectionWithAllPossibleMeasurements()
    {
        $totalBytes = TeraBytes::allocateUnits(1)->bytes()->add(
            GigaBytes::allocateUnits(1)->bytes()->add(
                MegaBytes::allocateUnits(1)->bytes()->add(
                    KiloBytes::allocateUnits(1)->bytes()->add(
                        Bytes::allocateUnits(1)
                    )
                )
            )
        );

        $actual = ByteCollection::allocateBytes(
            $totalBytes
        );


        $expected = $this->createCollection(
            [
                TeraBytes::allocateUnits(1),
                GigaBytes::allocateUnits(1),
                MegaBytes::allocateUnits(1),
                KiloBytes::allocateUnits(1),
                Bytes::allocateUnits(1)
            ]
        );

        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @test
     */
    public function shouldIterate()
    {
        $collection = $this->createCollection(
            [
                TeraBytes::allocateUnits(1),
                GigaBytes::allocateUnits(1),
                MegaBytes::allocateUnits(1),
                KiloBytes::allocateUnits(1),
                Bytes::allocateUnits(1)
            ]
        );


        $i = 0;
        foreach ($collection as $key => $bytes)
        {
            $this->assertSame($i, $key);
            $this->assertInstanceOf(Bytes::class, $bytes);
            $i++;
        }
        $this->assertSame(5, $i);
    }

    /**
     * @param $expected
     * @return ByteCollection
     */
    private function createCollection($expected)
    {
        $collection = new ByteCollection();
        array_map(function($unit) use ($collection) {
            $collection->add($unit);
        }, $expected);
        return $collection;
    }
}