<?php

namespace App\Hotelbook\Method\Builder;

/**
 * Interface BuilderInterface
 * @package App\Hotelbook\Method\Builder
 */
interface BuilderInterface
{
    /**
     * @param $params
     * @return mixed
     */
    public function build($params);
}
