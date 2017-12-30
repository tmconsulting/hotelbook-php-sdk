<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\BaseFormer;
use Hotelbook\Method\Builder\BaseBuilder;
use Hotelbook\Method\Former\FormerInterface;
use Hotelbook\Method\Former\Order as OrderFormer;

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
        return OrderFormer::class;
    }
}
