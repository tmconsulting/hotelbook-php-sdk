<?php

declare(strict_types=1);

namespace Hotelbook\Method\Builder;

/**
 * Class MoreDetails
 * @package Hotelbook\Method\Builder
 */
class MoreDetails implements BuilderInterface
{
    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        [$searchId, $resutId] = $params;

        $xml = new \SimpleXMLElement('<HotelSearchDetailsRequest/>');
        $hotelSearch = $xml->addChild('HotelSearches')->addChild('HotelSearch');

        $hotelSearch->addChild('SearchId', (string) $searchId);
        $hotelSearch->addChild('ResultId', (string) $resutId);

        return $xml->asXML();
    }
}
