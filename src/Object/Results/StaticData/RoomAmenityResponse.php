<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\RoomAmenity as RoomAmenityTransformer;

class RoomAmenityResponse extends ResultProceeder
{
    protected function setTransformer()
    {
        $this->transformer = new RoomAmenityTransformer();
    }
}
