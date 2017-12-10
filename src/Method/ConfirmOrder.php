<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\BaseFormer;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\FormerInterface;
use App\Hotelbook\Method\Former\Order as OrderFormer;

/**
 * An method implementation of Confirming order (after book)
 * Class ConfirmOrder
 * @package App\Hotelbook\Method\Dynamic
 */
class ConfirmOrder extends AbstractMethod
{
    /**
     * @param $params
     * @return ConfirmOrderResult
     */
    public function handle($params)
    {
        [$orderId, $itemId, $price, $currency] = $params;
        $result = $this->connector->request(
            'GET',
            'confirm_order',
            null,
            [
                'query' => [
                    'item_id' => $itemId,
                    'order_id' => $orderId,
                    'total_price' => $price,
                    'currency' => $currency
                ]
            ]
        );

        return $this->getResultObject($result);
    }

    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    protected function getFormerClass()
    {
        return OrderFormer::class;
    }
}
