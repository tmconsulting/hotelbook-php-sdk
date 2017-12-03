<?php

namespace App\Hotelbook\Results\Dictionary;

use App\Hotelbook\Results\Dictionary\Transformer\Meal as MealTransformer;
use App\Hotelbook\Results\ResultProceeder;

class MealResponse extends ResultProceeder
{
    /**
     * Set transformer default.
     */
    protected function setTransformer()
    {
        $this->transformer = new MealTransformer();
    }
}
