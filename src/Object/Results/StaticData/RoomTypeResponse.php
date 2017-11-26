<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\RoomType as RoomTypeTransformer;

class RoomTypeResponse extends ResultProceeder
{
    protected function setTransformer()
    {
        $this->transformer = new RoomTypeTransformer();
    }
}
