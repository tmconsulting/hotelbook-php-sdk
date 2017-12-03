<?php

namespace App\Hotelbook\Method;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Object\Hotel\Price;
use App\Hotelbook\Results\ResultProceeder;
use ReflectionClass;
use ReflectionException;
use SimpleXMLElement;

/**
 * Class AbstractMethod
 * @package App\Hotelbook\Method
 */
abstract class AbstractMethod implements MethodInterface
{
    /**
     * @var ConnectorInterface
     */
    protected $connector;

    /**
     * AbstractMethod constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
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
     * A method to get result from the response.
     * @param $result
     * @param array $values
     * @return array
     */
    protected function performResult($result, $values = [])
    {
        $errors = $this->getErrors($result);

        if (empty($errors)) {
            $values = $this->form($result);
        }

        return [$values, $errors];
    }

    /**
     * A method that creates an instance of result for every method.
     * @param $result
     * @param null $items
     * @return array|object
     */
    protected function getResultObject($result, $items = null)
    {
        try {
            if (!$items) {
                $items = $this->performResult($result);
            }

            return (new ReflectionClass($this->getResultClass()))->newInstanceArgs($items);
        } catch (ReflectionException $e) {
            return $items;
        }
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

    /**
     * A method to form the result out of XML.
     * @param $response
     * @return mixed
     */
    abstract protected function form($response);

    /**
     * A method to implement that returns the ::class string for the result objecct.
     * @return ResultProceeder
     */
    abstract protected function getResultClass();
}
