<?php

namespace App\Hotelbook\Method\Builder;

/**
 * Class Resort
 * @package App\Hotelbook\Method\Builder
 */
class Resort implements BuilderInterface
{
    /**
     * @param $params
     * @return array
     */
    public function build($params)
    {
        [$countryId] = $params;

        if (!$countryId) {
            return [];
        }

        return [
            'query' => [
                'country_id' => $countryId
            ]
        ];
    }
}