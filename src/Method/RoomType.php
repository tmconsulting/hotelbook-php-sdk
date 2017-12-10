<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\RoomType as RoomTypeFormer;

/**
 * Class RoomType
 * @package App\Hotelbook\Method\Dictionary
 */
class RoomType extends AbstractMethod
{
    /**
     * @param $params
     * @return RoomTypeResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'room_type', null, $params);
        return $this->getResultObject($result);
    }

    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    protected function getFormerClass()
    {
        return RoomTypeFormer::class;
    }
}
