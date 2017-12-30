<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 01.06.16
 * Project: provider
 */

declare(strict_types=1);

namespace Hotelbook\Object\Hotel\Search;

/**
 * Class Sale
 *
 * @link http://www.topukrainianhotels.com/mediaclub/glossariy/85
 * @package Hive\Common\Object\Hotel\SearchResult
 */
class Sale
{
    /**
     * Свободная продажа
     */
    const FREE = 'free';

    /**
     * Ограниченная свободная продажа
     */
    const ALLOTMENT = 'allotment';

    /**
     * Продажа по предварительному запросу.
     */
    const ON_REQUEST = 'onRequest';

    /**
     * Закрытая продажа
     */
    const CLOSE = 'close';

    /**
     * Значение константы.
     * Если отель/поставщик не предоставляет инфу о типе продажи,
     * то надо спросить об этом у представителя (скорее всего будет по-умолчанию self::FREE).
     *
     * Обязательный параметр.
     *
     * @var string
     */
    protected $type;

    /**
     * Поидее, кол-во комнат для ALLOTMENT, но хз на самом деле.
     *
     * Необязательный параметр.
     *
     * @var int
     */
    protected $limit;

    /**
     * Sale constructor.
     *
     * @param $type
     */
    public function __construct($type = self::FREE)
    {
        $this->setType($type);
    }

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
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
