<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Connector\Former\FormerInterface;
use App\Hotelbook\Connector\Former\OrderFormer;
use App\Hotelbook\Object\Results\ConfirmOrderResult;

class ConfirmOrder extends AbstractMethod
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

        $errors = $this->getErrors($result);
        $values = [];

        if (empty($errors)) {
            file_put_contents('confirm-order.xml', $result->asXML());
            $values = $this->form($result);
        }

        return new ConfirmOrderResult($values, $errors);
    }

    public function form($response)
    {
        return $this->former->form($response);
    }
}
