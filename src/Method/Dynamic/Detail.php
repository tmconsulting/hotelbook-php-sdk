<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider_hotelbook
 */

declare(strict_types=1);

namespace App\Hotelbook\Method\Dynamic;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dynamic\Detail as DetailFormer;
use App\Hotelbook\Results\Method\DetailResult;
use Money\Parser\StringToUnitsParser;

/**
 * An implementation to get detailed data of a hotel search.
 * Class Detail
 * @package App\Hotelbook\Method\Dynamic
 */
class Detail extends AbstractMethod
{
    protected $builder;
    protected $former;

    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new DetailFormer();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $this->builder->build($params);
    }

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
     * @param $results
     * @return array
     */
    protected function form($results)
    {
        return $this->former->form($results);
    }

    /**
     * @return string
     */
    protected function getResultClass()
    {
        return DetailResult::class;
    }
}
