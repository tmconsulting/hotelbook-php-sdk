<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\MoreDetails as Builder;
use Hotelbook\Method\Former\MoreDetails as Former;
use Money\Parser\StringToUnitsParser;

/**
 * Class MoreDetails
 * @package Hotelbook\Method
 */
class MoreDetails extends AbstractMethod
{
    /**
     * @param $buildedRequest
     * @return array|\Hotelbook\ResultProceeder|null
     */
    public function handle($buildedRequest)
    {
        $response = $this->connector->request('POST', 'hotel_search_details', $buildedRequest);

        return $this->getResultObject($response);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return Builder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return Former::class;
    }
}
