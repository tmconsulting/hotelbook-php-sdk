<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\CountryResponse;

class Country extends AbstractMethod
{
    public function build($params)
    {
        return $params;
    }

    public function handle($params)
    {
        $result = $this->connector->request('GET', 'countries');
        [$values, $errors] = $this->performResult($result);
        return new CountryResponse($values, $errors);
    }

    public function form($response)
    {
        $items = [];

        foreach ($response->Countries->Country as $country) {
            $items[] = [
                'id' => (string)$country->attributes()['id'],
                'name' => (string) $country
            ];
        }

        return $items;
    }
}
