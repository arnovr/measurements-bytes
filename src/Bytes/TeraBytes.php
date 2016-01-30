<?php

namespace Measurements\Bytes;

/**
 * Class TeraBytes
 * @package Arnovr\Storage\Domain\Model\Units
 */
class TeraBytes extends Bytes implements AbleToAllocateBytes, AbleToConvertToBytes
{
    /**
     * TeraBytes constructor.
     * @param integer $teraBytes
     */
    protected function __construct($teraBytes)
    {
        $this->assertCorrectByteValue($teraBytes);
        $this->units = $teraBytes;
        parent::__construct((int) $teraBytes * 1024 * 1024 * 1024 * 1024);
    }

    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes)
    {
        return TeraBytes::allocateUnits(
            intval($bytes->numberOfBytes() / 1024 / 1024 / 1024 / 1024)
        );
    }
}
