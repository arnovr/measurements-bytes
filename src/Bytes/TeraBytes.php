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
        parent::__construct((int) $teraBytes * 1024 * 1024 * 1024 * 1024);
    }

    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes)
    {
        return TeraBytes::allocateUnits(
            self::calculateUnitsFromBytes($bytes->numberOfBytes())
        );
    }

    /**
     * @param integer $bytes
     * @return integer
     */
    protected static function calculateUnitsFromBytes($bytes)
    {
        return intval($bytes / 1024 / 1024 / 1024 / 1024);
    }
}
