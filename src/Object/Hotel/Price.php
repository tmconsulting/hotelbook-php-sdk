<?php

namespace App\Hotelbook\Object\Hotel;

class Price
{
    private $amount;
    private $currency;

    private function precise($amount)
    {
        return (string) round((float)$amount, 1);
    }

    public function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $this->precise($currency);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}
