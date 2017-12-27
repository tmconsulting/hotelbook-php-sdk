<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Former;

/**
 * Class Book former
 * @package App\Hotelbook\Method\Former
 */
class Book extends BaseFormer
{
    /**
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $orderId = (int)$response->OrderId;
        $items = [];

        foreach ($response->Items->ItemId as $item) {
            $itemId = (int)($item);
            $item = current($item);

            $money = $this->money($item['TotalPrice'], $item['Currency']);
            $items[] = [
                'itemId' => $itemId,
                'price' => [
                    'sum' => $money->getAmount(),
                    'currency' => $money->getCurrency(),
                ]
            ];
        }

        return [
            'orderId' => $orderId,
            'items' => $items
        ];
    }
}
