<?php

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Method\Builder\Resort as ResortBuilder;
use App\Hotelbook\Method\Former\Resort as ResortFormer;

/**
 * A method to fetch all available Resorts
 * Class Resort
 * @package App\Hotelbook\Method\Dictionary
 */
class Resort extends AbstractMethod
{
    /**
     * @param $params
     * @return mixed
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'resorts', null, $params);
        //file_put_contents('resort.xml', $result->asXML());
        return $this->getResultObject($result);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return ResortBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return ResortFormer::class;
    }
}
