<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\RoomSize as RoomSizeFormer;

/**
 * A method to fetch all available hotel types.
 * Class RoomSize
 * @package App\Hotelbook\Method\Dictionary
 */
class RoomSize extends AbstractMethod
{
    /**
     * @param $params
     * @return RoomTypeResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_size', null, $params);
        return $this->getResultObject($result);
    }

    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    protected function getFormerClass()
    {
        return RoomSizeFormer::class;
    }
}
