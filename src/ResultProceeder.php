<?php

declare(strict_types=1);

namespace Hotelbook;

use Hotelbook\Exception\ResponseException;

class ResultProceeder
{
    /**
     * @var array of new Error() objects
     */
    protected $errors;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * ResultProceeder constructor.
     *
     * @param array $items
     * @param array $errors
     * @param bool $throwsException
     */
    public function __construct(array $items, array $errors = [], $throwsException = true)
    {
        $this->setItems($items);
        $this->setErrors($errors);

        if ($throwsException) {
            $this->throwExceptionIfNeeded();
        }
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

    protected function throwExceptionIfNeeded()
    {
        if($this->hasErrors()) {
            throw new ResponseException(1, 'Something went wrong with request. Run $result->getErrors() to get this data. ');
        }
    }
}
