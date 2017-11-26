<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\RoomSizeResponse;

class RoomSize extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $params;
    }

    /**
     * @param $params
     * @return RoomTypeResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_size', null, $params);
        [$values, $errors] = $this->performResult($result);
        return new RoomSizeResponse($values, $errors);
    }

    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->RoomSizes->RoomSize as $roomSize) {
            $items[] = [
                'id' => (int)$roomSize->attributes()['id'],
                'shortName' => (string)$roomSize->attributes()['name'],
                'pax' => (int)$roomSize->attributes()['pax'],
                'children' => (bool)$roomSize->attributes()['children'],
                'cots' => (int)$roomSize->attributes()['cots'],
                'searchable' => (bool)$roomSize->attributes()['search'],
                'fullName' => (string)$roomSize
            ];
        }

        return $items;
    }
}
