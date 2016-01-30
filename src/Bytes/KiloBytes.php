<?php

namespace Measurements\Bytes;

/**
 * Class KiloBytes
 * @package Measurements\Bytes
 */
class KiloBytes extends Bytes implements AbleToAllocateBytes, AbleToConvertToBytes
{
    /**
     * GigaBytes constructor.
     * @param integer $kiloBytes
     */
    protected function __construct($kiloBytes)
    {
        $this->assertCorrectByteValue($kiloBytes);
        $this->units = $kiloBytes;
        parent::__construct((int) $kiloBytes * 1024);
    }

    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes)
    {
        return KiloBytes::allocateUnits(
            intval($bytes->numberOfBytes() / 1024)
        );
    }
}
