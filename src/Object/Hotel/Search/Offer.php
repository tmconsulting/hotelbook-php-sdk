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

/**
 * Class Offer
 *
 * @package Hive\Common\Object\Hotel\SearchResult
 */
class Offer
{
    /**
     * Идентификатор предложения.
     * Обязательный аргумент.
     *
     * @var int
     */
    protected $id;

    /**
     * Включен ли НДС (true – да, false – нет).
     * Если null - не облагается налогом или инфа не предоставлена.
     * Обязательный аргумент.
     *
     * @var bool
     */
    protected $vat;

    /**
     * Тип продажи и её характеристики.
     * Обязательный аргумент. @todo: так ли это?
     *
     * @var Sale
     */
    protected $sale;

    /**
     * Типы комнат
     * Обязательный аргумент.
     *
     * @var array
     */
    protected $rooms;

    /**
     * Массив специальных предложений, если таковые были предоставлены поставщиками.
     * В массив кладется объект.
     *
     * Необязательный аргумент.
     *
     * @var array
     */
    protected $specials;

    /**
     * Тариф предложения.
     *
     * Необязательный аргумент.
     *
     * @var Tariff
     */
    protected $tariff;

    /**
     * Дополнительная информация о предложении.
     * Внимание! Хотелбук пишет информацию по тарифам, в блядь, доп. инфо! Ебись он конём!
     * --------> Сюда запрещено, класть тарифы и прочее, если это можно распарсить
     * --------> регулярками и положить в соотв. раздел объекта.
     *
     * Необязательный аргумент.
     *
     * @var string
     */
    protected $info;

    /**
     * Offer constructor.
     *
     * @param $id
     * @param array $rooms
     * @param $sale
     * @param bool $vat
     */
    public function __construct($id, array $rooms, $sale = null, $vat = false)
    {
        $this->setId($id);
        $this->setVat($vat);
        // По умолчанию открытая продажа.
        $this->setSale($sale ?: new Sale(Sale::FREE));
        $this->setRooms($rooms);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isVat()
    {
        return $this->vat;
    }

    /**
     * @param boolean $vat
     * @return $this
     */
    public function setVat(bool $vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @return Sale
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * @param Sale $sale
     * @return $this
     */
    public function setSale(Sale $sale)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * @param $special
     * @return $this
     */
    public function setSpecial(Special $special)
    {
        $this->specials[] = $special;

        return $this;
    }

    /**
     * @return array
     */
    public function getSpecials()
    {
        return $this->specials;
    }

    /**
     * @return Tariff
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * @param Tariff $tariff
     * @return $this
     */
    public function setTariff(Tariff $tariff)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * @param Room $room
     * @return $this
     */
    public function setRoom(Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * @return array
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param array $rooms
     * @return $this
     */
    public function setRooms(array $rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     * @return $this
     */
    public function setInfo(string $info)
    {
        $this->info = $info;

        return $this;
    }
}