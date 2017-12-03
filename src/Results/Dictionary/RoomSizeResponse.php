<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook\Results\Dictionary\Transformer\RoomSize as RoomSizeTransformer;
use App\Hotelbook\Results\ResultProceeder;

class RoomSizeResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new RoomSizeTransformer();
    }
}
