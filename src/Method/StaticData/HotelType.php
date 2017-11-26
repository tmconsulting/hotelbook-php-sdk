<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\HotelTypeResponse;

class HotelType  extends AbstractMethod
{
    public function build($params)
    {
        return $params;
    }

    public function handle($params)
    {
        $results = $this->connector->request('GET', 'hotel_type');
        [$values, $errors] = $this->performResult($results);
        return new HotelTypeResponse($values, $errors);
    }

    public function form($response)
    {
        $items = [];

        foreach ($response->HotelTypes->Type as $hotelType) {
            $items[] = [
                'id' => (int) $hotelType->attributes()['id'],
                'title' => (string) $hotelType
            ];
        }

        return $items;
    }
}