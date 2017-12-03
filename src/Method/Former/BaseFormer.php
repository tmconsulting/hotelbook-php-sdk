<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former;

use App\Hotelbook\Object\Hotel\Price;

abstract class BaseFormer
{
    /**
     * Method for forming the response to the format
     * @param $response
     * @return mixed
     */
    abstract public function form($response);

    /**
     * @param $sum
     * @param $currency
     * @return Money
     */
    public function money($sum, $currency)
    {
        return new Price($sum, $currency);
    }
}
