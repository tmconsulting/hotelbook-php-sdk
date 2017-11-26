<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;

class RoomType extends AbstractMethod
{
    private $connector;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    public function build($params)
    {
        return $params;
    }

    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_type', null, $params);
        file_put_contents('room-type-response.xml', $result->asXML());
        [$values, $errors] = $this->performResult($result);
        return new CityResponse($values, $errors);
    }

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
