<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former\Dictionary;

use App\Hotelbook\Method\Former\BaseFormer;

class Country extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->Countries->Country as $country) {
            $items[] = [
                'id' => (string)$country->attributes()['id'],
                'name' => (string)$country
            ];
        }

        return $items;
    }
}
