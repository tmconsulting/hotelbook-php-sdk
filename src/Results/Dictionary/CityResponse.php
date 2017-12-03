<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook\Results\Dictionary\Transformer\City as CityTransformer;
use App\Hotelbook\Results\ResultProceeder;

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
