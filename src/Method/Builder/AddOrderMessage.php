<?php

declare(strict_types=1);

namespace Hotelbook\Method\Builder;

class AddOrderMessage implements BuilderInterface
{
    public function build($params)
    {
        [$orderId, $message] = $params;

        $xml = new \SimpleXMLElement('<AddOrderMessageRequest/>');

        $xml->addChild('OrderId', (string) $orderId);
        $xml->addChild('Message')->addChild('Message', (string) $message);

        return $xml->asXML();
    }
}
