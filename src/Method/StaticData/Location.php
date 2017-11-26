<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\LocationResponse;

class Location extends AbstractMethod
{
    public function build($params)
    {
        return $params;
    }

    public function handle($params)
    {
        $result = $this->connector->request('GET', 'location');
        [$values, $errors] = $this->performResult($result);
        return new LocationResponse($values, $errors);
    }

    public function form($response)
    {
        $items = [];

        foreach ($response->Locations->Location as $location) {
            $items[] = [
                'id' => (int) $location->attributes()['id'],
                'title' => (string) $location,
                'cityId' => (int) $location->attributes()['city'],
                'isGlobal' => (bool) $location->attributes()['is_global']
            ];
        }

        return $items;
    }
}
