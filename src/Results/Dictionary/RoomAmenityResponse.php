<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook\Results\Dictionary\Transformer\RoomAmenity as RoomAmenityTransformer;
use App\Hotelbook\Results\ResultProceeder;

class RoomAmenityResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new RoomAmenityTransformer();
    }
}
