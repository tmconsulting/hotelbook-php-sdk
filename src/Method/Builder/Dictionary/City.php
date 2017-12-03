<?php

namespace App\Hotelbook\Method\Builder\Dictionary;

use App\Hotelbook\Method\Builder\BuilderInterface;

class City implements BuilderInterface{

    /**
     * @param $params
     * @return array
     */
    public function build($params)
    {
        [$country] = $params;

        if (empty($country)) {
            return [];
        }

        return [
            'query' => [
                'country_id' => $country->getId()
            ]
        ];
    }
}