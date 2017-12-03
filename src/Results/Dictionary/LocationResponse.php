<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook\Results\Dictionary\Transformer\Location as LocationTransformer;
use App\Hotelbook\Results\ResultProceeder;

class LocationResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new LocationTransformer();
    }
}
