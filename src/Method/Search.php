<?php

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\Search as SearchBuilder;
use Hotelbook\Method\Former\Search as SearchFormer;
use Hotelbook\ResultProceeder;

/**
 * Class Search
 * @package App\Hotelbook\Method
 */
class Search extends AbstractMethod
{
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @param $results <- builds results
     * @return mixed
     */
    public function handle($results)
    {
        $response = $this->connector->request('POST', 'hotel_search', $results);
        return $this->getResultObject($response, null, ResultProceeder::class, false);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return SearchBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return SearchFormer::class;
    }
}
