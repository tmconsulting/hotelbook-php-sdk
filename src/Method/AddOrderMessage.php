<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\ResultProceeder;
use Money\Parser\StringToUnitsParser;
use Hotelbook\Method\Builder\AddOrderMessage as AddOrderMessageBuilder;
use Hotelbook\Method\Former\AddOrderMessage as AddOrderMessageFormer;

class AddOrderMessage extends AbstractMethod
{
    public function handle($xml)
    {
        $response = $this->connector->request('POST', 'add_order_message', $xml);

        return $this->getResultObject($response, null, ResultProceeder::class, false);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return AddOrderMessageBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return AddOrderMessageFormer::class;
    }
}
