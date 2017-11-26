<?php

namespace App\Hotelbook\Object\Results\StaticData\Transformer;

use App\Hotelbook\Object\Results\TransformerInterface;
use App\Hotelbook\Object\Hotel\Dictionary\Country as CountryObject;

class Country implements TransformerInterface
{
    public function transform(array $items)
    {
        return array_map(function ($item) {
            return new CountryObject($item['id'], $item['name']);
        }, $items);
    }
}
