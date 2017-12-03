<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former\Dictionary;

use App\Hotelbook\Method\Former\BaseFormer;

class City extends BaseFormer
{
    public function form($response)
    {
        $items = [];

        foreach ($response->Cities->City as $city) {
            $attributes = $city->attributes();

            $items[] = [
                'id' => (int)$attributes['id'],
                'countryId' => (int)$attributes['country'],
                'hotelCount' => (int)$attributes['hotel_count'],
                'vehicleRent' => (int)$attributes['has_vehicle_rent'],
                'lat' => (float)$attributes['latitude'],
                'lgn' => (float)$attributes['longitude'],
                'name' => (string)$city,
            ];
        }

        return $items;
    }
}
