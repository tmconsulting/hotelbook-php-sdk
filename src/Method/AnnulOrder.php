<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Order as OrderFormer;

/**
 * The class for method to Annul the order (before confirm)
 * Class AnnulOrder
 * @package App\Hotelbook\Method\Dynamic
 */
class AnnulOrder extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function handle($params)
    {
        [$orderId, $itemId] = $params;

        $result = $this->connector->request(
            'GET',
            'cancellation_order',
            null,
            [
                'query' => [
                    'item_id' => $itemId,
                    'order_id' => $orderId
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
