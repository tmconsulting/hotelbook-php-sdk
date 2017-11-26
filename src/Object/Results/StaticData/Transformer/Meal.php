<?php

namespace App\Hotelbook\Object\Results\StaticData\Transformer;

use App\Hotelbook\Object\Hotel\Meal as MealObject;
use App\Hotelbook\Object\Results\TransformerInterface;

class Meal implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new MealObject($item['id'], $item['title']);
        }, $items);
    }
}
