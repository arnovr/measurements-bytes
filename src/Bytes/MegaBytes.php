<?php

namespace Measurements\Bytes;

/**
 * Class MegaBytes
 * @package Measurements\Bytes
 */
class MegaBytes extends Bytes implements AbleToAllocateBytes
{
    /**
     * MegaBytes constructor.
     * @param integer $megaBytes
     */
    protected function __construct($megaBytes)
    {
        $this->assertCorrectByteValue($megaBytes);
        parent::__construct((int) $megaBytes * 1024 * 1024);
    }

    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes)
    {
        return MegaBytes::allocateUnits(
            self::calculateUnitsFromBytes($bytes->numberOfBytes())
        );
    }

    /**
     * @param integer $bytes
     * @return integer
     */
    protected static function calculateUnitsFromBytes($bytes)
    {
        return intval($bytes / 1024 / 1024);
    }
}
