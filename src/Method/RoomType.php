<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\RoomType as RoomTypeFormer;

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
        return RoomTypeFormer::class;
    }
}
