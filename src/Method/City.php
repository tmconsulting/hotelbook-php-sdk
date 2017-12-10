<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\City as CityBuilder;
use App\Hotelbook\Method\Former\City as CityFormer;

/**
 * Dictionary - Get Cities method
 * Class City
 * @package App\Hotelbook\Method\Dictionary
 */
class City extends AbstractMethod
{
    /**
     * @param $params
     * @return CityResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'cities', null, $params);
        return $this->getResultObject($result);
    }

    protected function getBuilderClass()
    {
        return CityBuilder::class;
    }

    protected function getFormerClass()
    {
        return CityFormer::class;
    }
}
