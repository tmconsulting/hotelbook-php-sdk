<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\RoomSize as RoomSizeTransformer;

class RoomSizeResponse extends ResultProceeder
{
    protected function setTransformer()
    {
        $this->transformer = new RoomSizeTransformer();
    }
}
