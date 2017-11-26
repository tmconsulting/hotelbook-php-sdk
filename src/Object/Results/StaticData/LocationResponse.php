<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\Location as LocationTransformer;

class LocationResponse extends ResultProceeder
{
    protected function setTransformer()
    {
        $this->transformer = new LocationTransformer();
    }
}
