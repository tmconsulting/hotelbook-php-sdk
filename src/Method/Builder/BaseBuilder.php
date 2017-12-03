<?php

namespace App\Hotelbook\Method\Builder;

/**
 * Class BaseBuilder
 * @package App\Hotelbook\Method\Builder
 */
class BaseBuilder implements BuilderInterface
{
    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $params;
    }
}
