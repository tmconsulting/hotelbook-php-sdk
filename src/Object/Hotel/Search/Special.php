<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 01.06.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel\Search;

use DateTime;
use Money\Money;

/**
 * Class Special
 * Специальные предложения.
 *
 * @link http://xmldoc.hotelbook.pro/ru/hotels/hotel-search.html?highlight=specialoffer#specialoffer
 * @link http://images.acase.ru/sjas/xmlgw/sample/ru/HotelSearchResponse3.xml
 * @package Hive\Common\Object\Hotel\SearchResult
 */
class Special
{
    /**
     * Бесплатные ночи.
     */
    const FREE_NIGHTS = 'free_nights';

    /*/**
     * Идентификатор спец. предложения. И нахуя он нужен?
     *
     * @var int
     *!/
    protected $id;*/

    /**
     * Тип спец. предложения.
     *
     * @todo: Добавить больше констант для типов.
     * @link http://xmldoc.hotelbook.pro/ru/hotels/hotel-search.html?highlight=specialoffer#specialoffer
     *
     * @var string
     */
    protected $type;

    /**
     * Картинка.
     *
     * @var string
     */
    protected $img;

    /**
     * Текст спецпредложения
     *
     * @var string
     */
    protected $description;

    /**
     * Дата начала действия спец. предложения
     *
     * @var DateTime
     */
    protected $startedAt;

    /**
     * Дата окончания действия спец. предложения
     * @var DateTime
     */
    protected $endedAt;

    /**
     * Количество оплачиваемых ночей для спец. предложения типа “Живи/плати”
     *
     * @var int
     */
    protected $payNights;

    /**
     * Сумма скидки в валюте предложения.
     *
     * @var Money
     */
    protected $discount;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Money
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param Money $discount
     * @return $this
     */
    public function setDiscount(Money $discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * @param DateTime $startedAt
     * @return $this
     */
    public function setStartedAt(DateTime $startedAt)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndedAt()
    {
        return $this->endedAt;
    }

    /**
     * @param DateTime $endedAt
     * @return $this
     */
    public function setEndedAt(DateTime $endedAt)
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     * @return $this
     */
    public function setImg(string $img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return int
     */
    public function getPayNights()
    {
        return $this->payNights;
    }

    /**
     * @param int $payNights
     * @return $this
     */
    public function setPayNights(int $payNights)
    {
        $this->payNights = $payNights;

        return $this;
    }
}
