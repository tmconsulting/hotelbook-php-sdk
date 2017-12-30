<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\HotelList as HotelListBuilder;
use Hotelbook\Method\Former\HotelList as HotelListFormer;

/**
 * Dictionary - Get HotelList method
 * Class HotelList
 * @package App\Hotelbook\Method\Dictionary
 */
class HotelList extends AbstractMethod
{
    /**
     * @param $params
     * @return CityResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'hotel_list', null, $params);
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return HotelListBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return HotelListFormer::class;
    }
}
