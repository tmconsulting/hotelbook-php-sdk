<?php

namespace App\Hotelbook\Method;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Object\Hotel\Price;
use App\Hotelbook\ResultProceeder;
use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;

/**
 * Class AbstractMethod
 * @package App\Hotelbook\Method
 */
abstract class AbstractMethod
{
    /**
     * @var ConnectorInterface
     */
    protected $connector;

    /**
     * @var BaseBuilder
     */
    protected $builder;

    /**
     * @var CountryFormer
     */
    protected $former;

    /**
     * AbstractMethod constructor.
     * @throws ReflectionException
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;

        $this->builder = (new ReflectionClass($this->getBuilderClass()))->newInstanceArgs();
        $this->former = (new ReflectionClass($this->getFormerClass()))->newInstanceArgs();
    }

    /**
     * A method for the parent class to provide the class for the builders.
     * @return mixed
     */
    abstract protected function getBuilderClass();

    /**
     * A methof for the parent class to provide the class for the former
     * @return mixed
     */
    abstract protected function getFormerClass();

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $this->builder->build($params);
    }

    /**
     * A method that creates an instance of result for every method.
     * @param $result
     * @param null $items
     * @param string $resultClass
     * @return ResultProceeder|array|null
     */
    protected function getResultObject($result, $items = null, $resultClass = ResultProceeder::class, $needsErrors = true)
    {
        try {
            if (!$items) {
                $items = $this->performResult($result, $needsErrors);
            }
            return (new ReflectionClass($resultClass))->newInstanceArgs(array_merge($items, [$needsErrors]));
        } catch (ReflectionException $e) {
            return $items;
        }
    }

    /**
     * A method to get result from the response.
     * @param $result
     * @param array $values
     * @return array
     */
    protected function performResult($result, $values = [], $respectErrors = true)
    {
        $errors = $this->getErrors($result);

        if (empty($errors) || $respectErrors) {
            $values = $this->form($result);
        }

        return [$values, $errors];
    }

    /**
     * Get Errors by SimpleXML Result
     * @param SimpleXMLElement $element
     * @return array
     */
    protected function getErrors(SimpleXMLElement $element)
    {
        $errors = [];
        if (isset($element->Errors)) {
            foreach ($element->Errors->Error as $err) {
                $err = current($err);
                $errors[] = [
                    'id' => (string)$err['code'],
                    'desc' => (string)$err['description'],
                ];
            }
        }

        return $errors;
    }

    /**
     * @param $response
     * @return mixed
     */
    public function form($response)
    {
        return $this->former->form($response);
    }

    /**
     * Money proceeder
     * @param $sum
     * @param $currency
     * @return Money
     */
    protected function money($sum, $currency)
    {
        return new Price($sum, $currency);
    }
}
