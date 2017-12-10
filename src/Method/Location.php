<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Location as LocationFormer;

/**
 * A method to fetch all available Location
 * Class Location
 * @package App\Hotelbook\Method\Dictionary
 */
class Location extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'location');
        return $this->getResultObject($result);
    }

    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    protected function getFormerClass()
    {
        return LocationFormer::class;
    }
}
