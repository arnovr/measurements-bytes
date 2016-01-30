<?php

namespace Measurements\Bytes;

use Iterator;

/**
 * Class ByteCollection
 * @package Measurements\Bytes
 */
class ByteCollection implements AbleToConvertToBytes, AbleToAllocateBytes, Iterator
{
    /**
     * @var AbleToConvertToBytes[]
     */
    private $list = [];

    /**
     * @param AbleToConvertToBytes $bytes
     */
    public function add(AbleToConvertToBytes $bytes)
    {
        $this->list[] = $bytes;
    }

    /**
     * @return Bytes
     */
    public function bytes()
    {
        $totalBytes = Bytes::allocateUnits(0);
        foreach ($this->list as $bytes) {
            $totalBytes = $totalBytes->add(
                $bytes
            );
        }

        return $totalBytes;
    }

    /**
     * @param Bytes $bytes
     * @return ByteCollection
     */
    public static function allocateBytes(Bytes $bytes)
    {
        $byteCollection = new ByteCollection();

        while ($bytes->numberOfBytes() !== 0) {
            $largestPossible = self::findLargestUnitOfMeasurementPossible($bytes);

            $byteCollection->add($largestPossible);

            $bytes = $bytes->subtract(
                $largestPossible->bytes()
            );
        }
        return $byteCollection;
    }

    /**
     * @return AbleToConvertToBytes|false
     */
    public function rewind()
    {
        return reset($this->list);
    }

    /**
     * @return AbleToConvertToBytes|false
     */
    public function current()
    {
        return current($this->list);
    }

    /**
     * @return integer|null
     */
    public function key()
    {
        return key($this->list);
    }

    /**
     * @return AbleToConvertToBytes|false
     */
    public function next()
    {
        return next($this->list);
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return key($this->list) !== null;
    }

    /**
     * @param Bytes $bytes
     * @return Bytes
     */
    private static function findLargestUnitOfMeasurementPossible(Bytes $bytes)
    {
        $tb = TeraBytes::allocateBytes($bytes);
        if (!$tb->hasZeroBytes()) {
            return $tb;
        }
        $gb = GigaBytes::allocateBytes($bytes);
        if (!$gb->hasZeroBytes()) {
            return $gb;
        }
        $mb = MegaBytes::allocateBytes($bytes);
        if (!$mb->hasZeroBytes()) {
            return $mb;
        }
        $kb = KiloBytes::allocateBytes($bytes);
        if (!$kb->hasZeroBytes()) {
            return $kb;
        }
        return Bytes::allocateBytes($bytes);
    }
}
