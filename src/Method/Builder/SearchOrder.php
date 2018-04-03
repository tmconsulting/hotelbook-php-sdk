<?php

declare(strict_types=1);

namespace Hotelbook\Method\Builder;

use Hotelbook\Object\Method\SearchOrder\SearchOrderParams;
use SimpleXMLElement;

/**
 * Class SearchOrder
 * @package Hotelbook\Method\Builder
 */
class SearchOrder implements BuilderInterface
{
    /**
     * @param SearchOrderParams $searchOrderParams
     * @return mixed
     */
    public function build($searchOrderParams)
    {
        $xml = new SimpleXMLElement('<OrderListRequest/>');

        $searchOrderParams = current($searchOrderParams);

        if (!empty($searchOrderParams->getCheckInFrom())) {
            $xml->addChild('CheckInFrom', $searchOrderParams->getCheckInFrom());
        }

        if (!empty($searchOrderParams->getCheckInTo())) {
            $xml->addChild('CheckInTo', $searchOrderParams->getCheckInTo());
        }

        if (!empty($searchOrderParams->getCreatedFrom())) {
            $xml->addChild('CreatedFrom', $searchOrderParams->getCreatedFrom());
        }

        if (!empty($searchOrderParams->getCreatedTo())) {
            $xml->addChild('CreatedTo', $searchOrderParams->getCreatedTo());
        }

        return $xml->asXML();
    }
}
