<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\CurrencyRate as CurrencyRateFormer;

/**
 * CurrencyRate get currency rates method
 * Class CurrencyRate
 * @package App\Hotelbook\Method\Dictionary
 */
class CurrencyRate extends AbstractMethod
{
    /**
     * @param $params
     * @return CityResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'currency_rates_info', null, $params);
        file_put_contents('currency-rate.xml', $result->asXML());
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
        return CurrencyRateFormer::class;
    }
}
