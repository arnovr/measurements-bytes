<?php

namespace Measurements\Bytes;

/**
 * Interface AbleToAllocateBytes
 * @package Measurements\Bytes
 */
interface AbleToAllocateBytes
{
    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes);
}
