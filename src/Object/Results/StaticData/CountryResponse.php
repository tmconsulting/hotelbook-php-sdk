<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\Country as CountryTransformer;

class CountryResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new CountryTransformer();
    }
}
