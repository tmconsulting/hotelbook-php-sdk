<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Detail as DetailFormer;
use Money\Parser\StringToUnitsParser;

/**
 * An implementation to get detailed data of a hotel search.
 * Class Detail
 * @package App\Hotelbook\Method\Dynamic
 */
class Detail extends AbstractMethod
{
    /**
     * @param $results <- builds results
     * @return mixed
     */
    public function handle($results)
    {
        [$value, $byName] = $results;

        $optionKey = $byName ? 'hotel_name' : 'hotel_id';
        $results = $this->connector->request('GET', 'hotel_detail', null, [
            'query' => [$optionKey => $value]
        ]);

        return $this->getResultObject($results);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return BaseBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return DetailFormer::class;
    }
}
