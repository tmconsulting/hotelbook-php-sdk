<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\HotelType as HotelTypeFormer;

/**
 * A method to fetch all available hotel types.
 * Class HotelType
 * @package App\Hotelbook\Method\Dictionary
 */
class HotelType extends AbstractMethod
{
    /**
     * @param $params
     * @return HotelTypeResponse
     */
    public function handle($params)
    {
        $results = $this->connector->request('GET', 'hotel_type');
        return $this->getResultObject($results);
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
        return HotelTypeFormer::class;
    }
}
