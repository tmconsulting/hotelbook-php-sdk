<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object;

/**
 * Class SearchResult
 *
 * @package Hive\Common\Object
 */
class SearchResult
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @var array of new Error() objects
     */
    protected $errors;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * SearchResult constructor.
     *
     * @param array $items
     * @param array $errors
     */
    public function __construct(array $items, array $errors = [])
    {
        $this->items = $items;
        $this->errors = $errors;
    }

    /**
     * @param Error $error
     * @return $this
     */
    public function setError(Error $error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->getErrors());
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function setItem(array $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }
}