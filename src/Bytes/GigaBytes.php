<?php

namespace Measurements\Bytes;

/**
 * Class GigaBytes
 * @package Measurements\Bytes
 */
class GigaBytes extends Bytes implements AbleToAllocateBytes, AbleToConvertToBytes
{
    /**
     * GigaBytes constructor.
     * @param integer $gigaBytes
     */
    protected function __construct($gigaBytes)
    {
        $this->assertCorrectByteValue($gigaBytes);
        $this->units = $gigaBytes;
        parent::__construct((int) $gigaBytes * 1024 * 1024 * 1024);
    }

    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes)
    {
        return GigaBytes::allocateUnits(
            intval($bytes->numberOfBytes() / 1024 / 1024 / 1024)
        );
    }
}
