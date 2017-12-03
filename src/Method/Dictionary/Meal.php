<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Dictionary;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\BaseBuilder;
use App\Hotelbook\Method\Former\Dictionary\Meal as MealFormer;
use App\Hotelbook\Results\Dictionary\MealResponse;

/**
 * A method to fetch all available hotel meal types.
 * Class Meal
 * @package App\Hotelbook\Method\Dictionary
 */
class Meal extends AbstractMethod
{
    /**
     * @var BaseBuilder
     */
    protected $builder;
    /**
     * @var MealFormer
     */
    protected $former;

    /**
     * Meal constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BaseBuilder();
        $this->former = new MealFormer();
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
     * @param $params
     * @return MealResponse
     */
    public function handle($params)
    {
        $result = $this->connector->request('GET', 'meal');
        [$values, $errors] = $this->performResult($result);
        return new MealResponse($values, $errors);
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    protected function getResultClass()
    {
        return MealResponse::class;
    }

    /**
     * @param $response
     * @return array
     */
    protected function form($response)
    {
        return $this->former->form($response);
    }
}
