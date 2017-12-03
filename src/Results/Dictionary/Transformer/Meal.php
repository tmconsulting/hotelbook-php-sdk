<?php

namespace App\Hotelbook\Results\Dictionary\Transformer;

use App\Hotelbook\Object\Hotel\Meal as MealObject;
use App\Hotelbook\Results\TransformerInterface;

class Meal implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new MealObject($item['id'], $item['title']);
        }, $items);
    }
}
