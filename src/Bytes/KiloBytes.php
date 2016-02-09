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
        parent::__construct((int) $kiloBytes * 1024);
    }

    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes)
    {
        return KiloBytes::allocateUnits(
            self::calculateUnitsFromBytes($bytes->numberOfBytes())
        );
    }

    /**
     * @param integer $bytes
     * @return integer
     */
    protected static function calculateUnitsFromBytes($bytes)
    {
        return intval($bytes / 1024);
    }
}
