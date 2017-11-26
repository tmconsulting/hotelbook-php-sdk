<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Hotel\Dictionary\City;
use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\City as CityTransformer;

class CityResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new CityTransformer();
    }
}
