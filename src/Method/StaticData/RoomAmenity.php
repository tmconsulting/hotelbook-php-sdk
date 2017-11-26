<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\RoomAmenityResponse;

class RoomAmenity extends AbstractMethod
{
    public function build($params)
    {
        return $params;
    }

    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_amenity', null, $params);
        [$values, $errors] = $this->performResult($result);
        return new RoomAmenityResponse($values, $errors);
    }

    public function form($response)
    {
        $items = [];

        foreach ($response->RoomAmenities->Amenity as $roomAmenity) {
            $items[] = [
                'id' => (int)$roomAmenity->attributes()['id'],
                'title' => (string)$roomAmenity
            ];
        }

        return $items;
    }
}
