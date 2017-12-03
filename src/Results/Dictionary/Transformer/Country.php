<?php

namespace App\Hotelbook\Results\Dictionary\Transformer;

use App\Hotelbook\Object\Hotel\Dictionary\Country as CountryObject;
use App\Hotelbook\Results\TransformerInterface;

class Country implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new CountryObject($item['id'], $item['name']);
        }, $items);
    }
}
