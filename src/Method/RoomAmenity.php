<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\RoomAmenity as RoomAmenityFormer;

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
        return RoomAmenityFormer::class;
    }
}
