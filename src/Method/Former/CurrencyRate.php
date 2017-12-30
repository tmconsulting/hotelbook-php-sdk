<?php

namespace Hotelbook\Method\Former;

/**
 * Class CurrencyRate
 * @package App\Hotelbook\Method\Former
 */
class CurrencyRate extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $result = [];

        foreach ($response->CurrencyRatesInfo->Currency as $currency) {
            $currency = current($currency);
            $result[] = [
                'from' => (string)$currency['from'],
                'to' => (string)$currency['to'],
                'rate' => (float)$currency['rate']
            ];
        }

        return $result;
    }
}