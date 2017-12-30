<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\Country as CountryFormer;

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
        return CountryFormer::class;
    }

}
