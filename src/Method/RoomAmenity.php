<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\RoomAmenity as RoomAmenityFormer;

/**
 * Class RoomAmenity
 * @package App\Hotelbook\Method\Dictionary
 */
class RoomAmenity extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_amenity', null, $params);
        return $this->getResultObject($result);
    }

    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    protected function getFormerClass()
    {
        return RoomAmenityFormer::class;
    }
}
