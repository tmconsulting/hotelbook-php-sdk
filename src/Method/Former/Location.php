<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

class Location extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->Locations->Location as $location) {
            $items[] = [
                'id' => (int)$location->attributes()['id'],
                'title' => (string)$location,
                'cityId' => (int)$location->attributes()['city'],
                'isGlobal' => (bool)$location->attributes()['is_global']
            ];
        }

        return $items;
    }
}
