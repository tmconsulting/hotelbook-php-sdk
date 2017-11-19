<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\CityResponse;

class City extends AbstractMethod
{
    private $connector;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    public function build($params)
    {
        [$country] = $params;

        if (!empty($country)) {
            return [
                'query' => [
                    'country_id' => $country->getId()
                ]
            ];
        } else {
            return [];
        }
    }

    public function handle($params)
    {
        $result = $this->connector->request('GET', 'cities', null, $params);
        [$values, $errors] = $this->performResult($result);
        return new CityResponse($values, $errors);
    }

    public function form($response)
    {
        $items = [];

        foreach ($response->Cities->City as $city) {
            $attributes = $city->attributes();

            $items[] = [
                'id' => (int) $attributes['id'],
                'countryId' => (int) $attributes['country'],
                'hotelCount' => (int) $attributes['hotel_count'],
                'vehicleRent' => (int) $attributes['has_vehicle_rent'],
                'lat' => (float) $attributes['latitude'],
                'lgn' => (float) $attributes['longitude'],
                'name' => (string) $city,
            ];
        }

        return $items;
    }
}
