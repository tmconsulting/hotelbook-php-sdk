<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 29.04.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel\Search;

use App\Hotelbook\Object\Pax;

/**
 * Class Room
 *
 * Список комнат в предложении.
 *
 * @link: http://xmldoc.hotelbook.pro/ru/hotels/hotel-search.html#id6
 * @link: https://images.acase.ru/sjas/xmlgw/sample/ru/HotelSearchResponse3.xml
 *
 * @package Hive\Common\Object\Hotel\Room
 */
class Room
{
    use Pax;

    /**
     * ID типа размера.
     *
     * Обязательный аргумент, если sizeAlias не указан.
     *
     * @var int
     */
    protected $sizeId;

    /**
     * Алиас.
     *
     * Обязательный аргумент, если sizeId не указан.
     *
     * @var string
     */
    protected $sizeAlias;

    /**
     * Название типа размера размещения (twin, double, single ...)
     *
     * Обязательный аргумент.
     *
     * @var string
     */
    protected $sizeName;

    /**
     * ID категории номера.
     *
     * Обязательный аргумент.
     *
     * @var int
     */
    protected $typeId;

    /**
     * Название категории номера.
     *
     * Обязательный аргумент.
     *
     * @var string
     */
    protected $typeName;

    /**
     * ID вида из номеров.
     *
     * Необязательный аргумент.
     *
     * @var int
     */
    protected $viewId;

    /**
     * Название вида из номера
     *
     * Необязательный аргумент.
     *
     * @var string
     */
    protected $viewName;

    /**
     * Разделение постельных принадлежностей на двоих (если true)
     *
     * Необязательный аргумент.
     *
     * @var bool
     */
    protected $sharingBedding;

    /**
     * Количество дополнительных кроватей, которые могут поставить в номер.
     *
     * Необязательный аргумент.
     *
     * @var BedOption
     */
    protected $bedOption;

    /**
     * @return mixed
     */
    public function getSizeId()
    {
        return $this->sizeId;
    }

    /**
     * @param int $sizeId
     * @return $this
     */
    public function setSizeId(int $sizeId)
    {
        $this->sizeId = $sizeId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSizeAlias()
    {
        return $this->sizeAlias;
    }

    /**
     * @param string $sizeAlias
     * @return $this
     */
    public function setSizeAlias(string $sizeAlias)
    {
        $this->sizeAlias = $sizeAlias;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSizeName()
    {
        return $this->sizeName;
    }

    /**
     * @param string $sizeName
     * @return $this
     */
    public function setSizeName(string $sizeName)
    {
        $this->sizeName = $sizeName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param int $typeId
     * @return $this
     */
    public function setTypeId(int $typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * @param mixed $typeName
     * @return $this
     */
    public function setTypeName(string $typeName)
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewId()
    {
        return $this->viewId;
    }

    /**
     * @param int $viewId
     * @return $this
     */
    public function setViewId(int $viewId)
    {
        $this->viewId = $viewId;

        return $this;
    }

    /**
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName;
    }

    /**
     * @param string $viewName
     * @return $this
     */
    public function setViewName(string $viewName)
    {
        $this->viewName = $viewName;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSharingBedding()
    {
        return $this->sharingBedding;
    }

    /**
     * @param boolean $sharingBedding
     * @return $this
     */
    public function setSharingBedding(bool $sharingBedding)
    {
        $this->sharingBedding = $sharingBedding;

        return $this;
    }

    /**
     * @return BedOption
     */
    public function getBedOption()
    {
        return $this->bedOption;
    }

    /**
     * @param BedOption $bedOption
     * @return $this
     */
    public function setBedOption(BedOption $bedOption)
    {
        $this->bedOption = $bedOption;

        return $this;
    }
}