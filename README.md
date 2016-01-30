[![Build Status](https://travis-ci.org/arnovr/measurements-bytes.svg?branch=master)](https://travis-ci.org/arnovr/measurements-bytes)

Unit of Measurement - Bytes
===========================
A small library to represent the bytes unit of measurement.
It makes life a little bit easier when converting bytes and gigabytes or subtracting or adding of each other

```php
<?php

use Measurements\Bytes\ByteCollection;
use Measurements\Bytes\GigaBytes;
use Measurements\Bytes\KiloBytes;

$kiloByte = KiloBytes::allocateUnits(1);
echo $kiloByte->numberOfBytes() . "\n";// represents (int) 1024
$gigaByte = GigaBytes::allocateUnits(1);
echo $gigaByte->numberOfBytes() . "\n"; // represents (int) 1073741824

# Subtract a kilobyte from original
$bytes = $gigaByte->subtract($kiloByte);
echo $bytes->numberOfBytes() . "\n"; // represents (int) 1073740800

# Add an extra gigabytes.
$awesomeBytes = $gigaByte->add($bytes);
echo $awesomeBytes->numberOfBytes() . "\n"; // represents (int) 2147482624

# Create a collection, which gives you a list of largest representatives
$collection = ByteCollection::allocateBytes($awesomeBytes);
foreach($collection as $byteType) {
    echo get_class($byteType) . ' - ' . $byteType->units() . "\n";
}

# Measurements\Bytes\GigaBytes - 1
# Measurements\Bytes\MegaBytes - 1023
# Measurements\Bytes\KiloBytes - 1023


echo $collection->bytes()->numberOfBytes() . "\n"; // represents (int) 2147482624
```

Installation
------------

```sh
$ composer.phar install #TODO
```