<?php

namespace App\Hotelbook\Object\Results\StaticData;

use App\Hotelbook\Object\Results\ResultProceeder;
use App\Hotelbook\Object\Results\StaticData\Transformer\Meal as MealTransformer;

class MealResponse extends ResultProceeder
{
    protected function setTransformer()
    {
        $this->transformer = new MealTransformer();
    }
}
