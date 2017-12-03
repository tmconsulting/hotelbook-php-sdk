<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook\Results\Dictionary\Transformer\RoomType as RoomTypeTransformer;
use App\Hotelbook\Results\ResultProceeder;

class RoomTypeResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new RoomTypeTransformer();
    }
}
