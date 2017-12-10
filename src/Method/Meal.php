<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Meal as MealFormer;

/**
 * A method to fetch all available hotel meal types.
 * Class Meal
 * @package App\Hotelbook\Method\Dictionary
 */
class Meal extends AbstractMethod
{
    /**
     * @param $params
     * @return MealResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'meal');
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return MealFormer::class;
    }
}
