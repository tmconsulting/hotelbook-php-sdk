<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook \Results\Dictionary\Transformer\Country as CountryTransformer;
use App\Hotelbook\Results\ResultProceeder;

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
