<?php

declare(strict_types=1);

namespace Hotelbook\Object\Method\SearchOrder;

/**
 * Class SearchOrderParams
 * @package Hotelbook\Object\Method\SearchOrderParams
 */
class SearchOrderParams
{
    /**
     * @var string
     */
    protected $createdFrom;
    /**
     * @var string
     */
    protected $createdTo;
    /**
     * @var string
     */
    protected $checkInFrom;
    /**
     * @var string
     */
    protected $checkInTo;

    /**
     * SearchOrderParams constructor.
     * @param string $createdFrom
     * @param string $createdTo
     * @param string $checkInFrom
     * @param string $checkInTo
     */
    public function __construct(
        string $createdFrom = '',
        string $createdTo = '',
        string $checkInFrom = '',
        string $checkInTo = ''
    ) {
        $this->createdFrom = $createdFrom;
        $this->createdTo = $createdTo;
        $this->checkInFrom = $checkInFrom;
        $this->checkInTo = $checkInTo;
    }

    /**
     * @return string
     */
    public function getCreatedFrom(): string
    {
        return $this->createdFrom;
    }

    /**
     * @param string $createdFrom
     */
    public function setCreatedFrom(string $createdFrom): void
    {
        $this->createdFrom = $createdFrom;
    }

    /**
     * @return string
     */
    public function getCreatedTo(): string
    {
        return $this->createdTo;
    }

    /**
     * @param string $createdTo
     */
    public function setCreatedTo(string $createdTo): void
    {
        $this->createdTo = $createdTo;
    }

    /**
     * @return string
     */
    public function getCheckInFrom(): string
    {
        return $this->checkInFrom;
    }

    /**
     * @param string $checkInFrom
     */
    public function setCheckInFrom(string $checkInFrom): void
    {
        $this->checkInFrom = $checkInFrom;
    }

    /**
     * @return string
     */
    public function getCheckInTo(): string
    {
        return $this->checkInTo;
    }

    /**
     * @param string $checkInTo
     */
    public function setCheckInTo(string $checkInTo): void
    {
        $this->checkInTo = $checkInTo;
    }


}