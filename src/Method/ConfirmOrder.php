<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Object\Results\CancelOrderResult;

class ConfirmOrder extends AbstractMethod
{
    private $connector;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    public function build($params)
    {
        return $params;
    }

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

        file_put_contents('confirm-order.xml', $result->asXML());
        //var_dump($result->asXML());
        die;
    }

    public function form($response)
    {
    }
}
