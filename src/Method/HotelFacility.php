<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\HotelFacility as HotelFacilityFormer;

/**
 * Dictionary - Get HotelList method
 * Class HotelCategory
 * @package App\Hotelbook\Method\Dictionary
 */
class HotelFacility extends AbstractMethod
{
    /**
     * @param $params
     * @return CityResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'hotel_facility', null, $params);
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
        return HotelFacilityFormer::class;
    }
}
