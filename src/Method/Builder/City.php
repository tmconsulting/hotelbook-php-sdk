<?php

namespace App\Hotelbook\Method\Builder;

class City implements BuilderInterface
{
    /**
     * @param $params
     * @return array
     */
    public function build($params)
    {
        [$countryId] = $params;

        if (empty($countryId)) {
            return [];
        }

        return [
            'query' => [
                'country_id' => $countryId
            ]
        ];
    }
}
