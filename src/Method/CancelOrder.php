<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Connector\Former\OrderFormer;
use App\Hotelbook\Object\Results\CancelOrderResult;

class CancelOrder extends AbstractMethod
{
    private $connector;
    private $former;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
        $this->former = new OrderFormer();
    }

    public function build($params)
    {
        return $params;
    }

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


        $errors = $this->getErrors($result);
        $values = [];

        if (empty($errors)) {
            $values = $this->form($result);
        }

        return new CancelOrderResult($values, $errors);
    }

    public function form($response)
    {
        return $this->former->form($response);
    }
}
