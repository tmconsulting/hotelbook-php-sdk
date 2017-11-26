<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\StaticData;

use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Object\Results\StaticData\MealResponse;

class Meal extends AbstractMethod
{
    public function build($params)
    {
        return $params;
    }

    public function handle($params)
    {
        $result = $this->connector->request('GET', 'meal');
        [$values, $errors] = $this->performResult($result);
        return new MealResponse($values, $errors);
    }

    public function form($response)
    {
        $items = [];

        foreach ($response->Meals->Meal as $meal) {
            $items[] = [
                'id' => (int) $meal->attributes()['id'],
                'title' => (string) $meal
            ];
        }

        return $items;
    }
}
