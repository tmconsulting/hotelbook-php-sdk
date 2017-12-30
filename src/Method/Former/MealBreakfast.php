<?php

declare(strict_types=1);

namespace Hotelbook\Method\Former;

/**
 * Class MealBreakfast
 * @package App\Hotelbook\Method\Former
 */
class MealBreakfast extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $items = [];

        foreach ($response->Breakfasts->Breakfast as $breakfast) {
            $items[] = [
                'id' => (int)$breakfast->attributes()['id'],
                'title' => (string)$breakfast
            ];
        }

        return $items;
    }
}
