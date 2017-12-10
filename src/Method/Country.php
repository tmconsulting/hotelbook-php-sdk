<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Country as CountryFormer;

/**
 * Dictionary method to fetch all available countries.
 * Class Country
 * @package App\Hotelbook\Method\Dictionary
 */
class Country extends AbstractMethod
{
    /**
     * @param $params
     * @return CountryResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'countries');
        return $this->getResultObject($result);
    }

    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    protected function getFormerClass()
    {
        return CountryFormer::class;
    }

}
