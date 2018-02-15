<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\HotelCategory as HotelCategoryFormer;

/**
 * Dictionary - Get HotelList method
 * Class HotelCategory
 * @package App\Hotelbook\Me9thod\Dictionary
 */
class HotelCategory extends AbstractMethod
{
    /**
     * @param $params
     * @return CityResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'hotel_cat', null, $params);
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
        return HotelCategoryFormer::class;
    }
}
