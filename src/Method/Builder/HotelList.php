<?php

namespace Hotelbook\Method\Builder;

/**
 * Class HotelList
 * @package App\Hotelbook\Method\Builder
 */
class HotelList implements BuilderInterface
{
    /**
     * @param $params
     * @return array
     */
    public function build($params)
    {
        [$cityId, $countryId] = $params;

        if (!$cityId && !$countryId) {
            return [];
        }
        $params = [];

        if ($cityId) {
            $params['city_id'] = $cityId;
        }

        if ($countryId) {
            $params['country_id'] = $countryId;
        }

        return [
            'query' => $params
        ];
    }
}