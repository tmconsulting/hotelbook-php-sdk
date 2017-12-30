<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 27.04.16
 * Project: provider
 */

declare(strict_types=1);

namespace Hotelbook\Object\Hotel\Dictionary;

/**
 * Class Country
 * @package App\Hotelbook\Object\Hotel\Dictionary
 */
class Country
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $isoAlpha2;

    /**
     * @var string
     */
    protected $isoAlpha3;

    /**
     * @var integer
     */
    protected $isoNumeric;

    /**
     * @var string
     */
    protected $currencyAlpha;

    /**
     * @var int
     */
    protected $currencyNumeric;

    /**
     * Флаг для СНГ.
     * @var bool
     */
    protected $cis;

    /**
     * @var bool
     */
    protected $schengen;

    /**
     * Country constructor.
     * @param int $id
     * @param string $name
     * @param string|null $isoAlpha2
     * @param string|null $isoAlpha3
     * @param int|null $isoNumeric
     * @param string|null $currencyAlpha
     * @param int|null $currencyNumeric
     * @param bool $cis
     * @param bool $schengen
     */
    public function __construct(
        int $id,
        string $name,
        string $isoAlpha2 = '',
        string $isoAlpha3 = '',
        int $isoNumeric = 0,
        string $currencyAlpha = '',
        int $currencyNumeric = 0,
        bool $cis = false,
        bool $schengen = false
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setIsoAlpha2($isoAlpha2);
        $this->setIsoAlpha3($isoAlpha3);
        $this->setIsoNumeric($isoNumeric);
        $this->setCurrencyAlpha($currencyAlpha);
        $this->setCurrencyNumeric($currencyNumeric);
        $this->setCIS($cis);
        $this->setSchengen($schengen);
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
     * @return Country
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getIsoAlpha2()
    {
        return $this->isoAlpha2;
    }

    /**
     * @param string $isoAlpha2
     */
    public function setIsoAlpha2(string $isoAlpha2)
    {
        $this->isoAlpha2 = $isoAlpha2;
    }

    /**
     * @return string
     */
    public function getIsoAlpha3()
    {
        return $this->isoAlpha3;
    }

    /**
     * @param string $isoAlpha3
     */
    public function setIsoAlpha3(string $isoAlpha3)
    {
        $this->isoAlpha3 = $isoAlpha3;
    }

    /**
     * @return int
     */
    public function getIsoNumeric()
    {
        return $this->isoNumeric;
    }

    /**
     * @param int $isoNumeric
     */
    public function setIsoNumeric(int $isoNumeric)
    {
        $this->isoNumeric = $isoNumeric;
    }

    /**
     * @return string
     */
    public function getCurrencyAlpha()
    {
        return $this->currencyAlpha;
    }

    /**
     * @param string $currencyAlpha
     */
    public function setCurrencyAlpha(string $currencyAlpha)
    {
        $this->currencyAlpha = $currencyAlpha;
    }

    /**
     * @return int
     */
    public function getCurrencyNumeric()
    {
        return $this->currencyNumeric;
    }

    /**
     * @param int $currencyNumeric
     */
    public function setCurrencyNumeric(int $currencyNumeric)
    {
        $this->currencyNumeric = $currencyNumeric;
    }

    /**
     * @return boolean
     */
    public function isCIS()
    {
        return $this->cis;
    }

    /**
     * @param boolean $cis
     */
    public function setCIS(bool $cis)
    {
        $this->cis = $cis;
    }

    /**
     * @return boolean
     */
    public function isSchengen()
    {
        return $this->schengen;
    }

    /**
     * @param boolean $schengen
     */
    public function setSchengen(bool $schengen)
    {
        $this->schengen = $schengen;
    }
}
