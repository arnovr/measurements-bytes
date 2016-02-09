<?php

namespace Measurements\Bytes;

/**
 * Class Bytes
 * @package Arnovr\Storage\Domain\Model\Units
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Bytes implements AbleToAllocateBytes, AbleToConvertToBytes
{
    /**
     * @var integer
     */
    protected $bytes;

    /**
     * Bytes constructor.
     * @param integer $bytes
     * @throws InvalidUnitException
     */
    protected function __construct($bytes)
    {
        $this->assertCorrectByteValue($bytes);
        $this->bytes = $bytes;
    }

    /**
     * @param integer $units
     * @return static
     */
    public static function allocateUnits($units)
    {
        return new static($units);
    }

    /**
     * @return integer
     */
    public function units()
    {
        return static::calculateUnitsFromBytes($this->numberOfBytes());
    }

    /**
     * @param Bytes $bytes
     * @return self
     */
    public static function allocateBytes(Bytes $bytes)
    {
        return clone $bytes;
    }

    /**
     * @return Bytes
     */
    public function bytes()
    {
        return Bytes::allocateUnits($this->bytes);
    }

    /**
     * @return integer
     */
    public function numberOfBytes()
    {
        return $this->bytes;
    }

    /**
     * @return boolean
     */
    public function hasZeroBytes()
    {
        return $this->bytes === 0;
    }

    /**
     * @return KiloBytes
     */
    public function kiloBytes()
    {
        return KiloBytes::allocateBytes(
            Bytes::allocateUnits(
                $this->numberOfBytes()
            )
        );
    }


    /**
     * @return MegaBytes
     */
    public function megaBytes()
    {
        return MegaBytes::allocateBytes(
            Bytes::allocateUnits(
                $this->numberOfBytes()
            )
        );
    }

    /**
     * @return GigaBytes
     */
    public function gigaBytes()
    {
        return GigaBytes::allocateBytes(
            Bytes::allocateUnits(
                $this->numberOfBytes()
            )
        );
    }

    /**
     * @return TeraBytes
     */
    public function teraBytes()
    {
        return TeraBytes::allocateBytes(
            Bytes::allocateUnits(
                $this->numberOfBytes()
            )
        );
    }

    /**
     * @param AbleToConvertToBytes $toAdd
     * @return static
     */
    public function add(AbleToConvertToBytes $toAdd)
    {
        return Bytes::allocateUnits(
            $this->numberOfBytes() + $toAdd->bytes()->numberOfBytes()
        );
    }

    /**
     * @param AbleToConvertToBytes $toSubtract
     * @return static
     */
    public function subtract(AbleToConvertToBytes $toSubtract)
    {
        return Bytes::allocateUnits(
            $this->numberOfBytes() - $toSubtract->bytes()->numberOfBytes()
        );
    }

    /**
     * @param Bytes $bytes
     * @return boolean
     */
    public function lesserThan(Bytes $bytes)
    {
        return $this->numberOfBytes() < $bytes->numberOfBytes();
    }

    /**
     * @param Bytes $bytes
     * @return boolean
     */
    public function equals(Bytes $bytes)
    {
        return $this->numberOfBytes() === $bytes->numberOfBytes();
    }

    /**
     * @param Bytes $bytes
     * @return bool
     */
    public function largerThan(Bytes $bytes)
    {
        return $this->numberOfBytes() > $bytes->numberOfBytes();
    }

    /**
     * @param $bytes
     * @throws InvalidUnitException
     */
    protected function assertCorrectByteValue($bytes)
    {
        if (!is_int($bytes)) {
            throw new InvalidUnitException('Bytes is expected to be an integer');
        }
        if ($bytes < 0) {
            throw new InvalidUnitException('Bytes could not be a negative value');
        }
    }

    /**
     * @param integer $bytes
     * @return integer
     */
    protected static function calculateUnitsFromBytes($bytes)
    {
        return $bytes;
    }
}
