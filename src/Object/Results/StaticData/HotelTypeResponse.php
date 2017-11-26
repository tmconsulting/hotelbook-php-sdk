<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\HotelType as HotelTypeTransformer;

class HotelTypeResponse extends ResultProceeder
{
    protected function setTransformer()
    {
        $this->transformer = new HotelTypeTransformer();
    }
}