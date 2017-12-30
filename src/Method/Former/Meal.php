<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

/**
 * Class Meal
 * @package App\Hotelbook\Method\Former
 */
class Meal extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->Meals->Meal as $meal) {
            $items[] = [
                'id' => (int)$meal->attributes()['id'],
                'title' => (string)$meal
            ];
        }

        return $items;
    }
}
