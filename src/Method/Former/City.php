<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

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
                'has_airport' => (int)$attributes['has_airport'],
                'lat' => (float)$attributes['latitude'],
                'lgn' => (float)$attributes['longitude'],
                'name' => (string)$city,
                'resort' => (string)$attributes['resort'],
            ];
        }

        return $items;
    }
}
