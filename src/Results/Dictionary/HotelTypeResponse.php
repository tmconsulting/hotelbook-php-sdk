<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook\Results\Dictionary\Transformer\HotelType as HotelTypeTransformer;
use App\Hotelbook\Results\ResultProceeder;

class HotelTypeResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new HotelTypeTransformer();
    }
}
