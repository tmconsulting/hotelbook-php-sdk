<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\RoomSize as RoomSizeFormer;

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
        return RoomSizeFormer::class;
    }
}
