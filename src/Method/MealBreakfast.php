<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\MealBreakfast as MealBreakfastFormer;

/**
 * A method to fetch all available hotel meal breakfast types.
 * Class MealBreakfast
 * @package App\Hotelbook\Method\Dictionary
 */
class MealBreakfast extends AbstractMethod
{
    /**
     * @param $params
     * @return MealResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'meal_breakfast');
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
        return MealBreakfastFormer::class;
    }
}
