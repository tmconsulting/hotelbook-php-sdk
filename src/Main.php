<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/17/17
 */

namespace App\Hotelbook;

use App\Hotelbook\Connector\Connector;
use App\Hotelbook\Method\AnnulOrder;
use App\Hotelbook\Method\Book;
use App\Hotelbook\Method\CancelOrder;
use App\Hotelbook\Method\ConfirmOrder;
use App\Hotelbook\Method\Detail;
use App\Hotelbook\Method\DynamicResolver;
use App\Hotelbook\Method\Search;
use App\Hotelbook\Object\Contact;
use App\Hotelbook\Object\Hotel\BookItem;
use App\Hotelbook\Object\Hotel\SearchParameter;
use App\Hotelbook\Object\Hotel\Tag;
use Carbon\Carbon;

/**
 * Class Main
 *
 * @package App\Hotelbook
 */
final class Main // implements HotelInterface
{
    use DynamicResolver;

    public $static;

    /**
     * Main constructor.
     */
    public function __construct($config)
    {
        $connector = $this->makeConnector($config);
        $this->setMethods($connector);

        $this->static = new StaticData($connector);
    }

    /**
     * Метод для установки всех существующих методов
     * @param $connector
     */
    private function setMethods($connector)
    {
        $this->setMethod('search', new Search($connector));
        $this->setMethod('detail', new Detail($connector));
        $this->setMethod('book', new Book($connector));
        $this->setMethod('annulOrder', new AnnulOrder($connector));
        $this->setMethod('cancelOrder', new CancelOrder($connector));
        $this->setMethod('confirmOrder', new ConfirmOrder($connector));
    }

    /**
     * Метод для получения инстанса коннектора
     * Далее конфиг будет пробрасываться через агента сюда
     * @param $config
     * @return Connector
     */
    private function makeConnector($config)
    {
        return new Connector($config);
    }

    /**
     * Метод для реализации поиска отелей.
     * $value - идентификатор, название отеля или id отеля, зависит от опций в $parameter.
     * $checkInDate - дата заезда
     * $checkOutDate - дата выезда
     * $passengers - пассажиры.
     * $parameter - объект опций для поиска.
     *
     * @param $value
     * @param \Carbon\Carbon $checkInDate
     * @param \Carbon\Carbon $checkOutDate
     * @param \App\Hotelbook\Object\Hotel\SearchPassenger[] $rooms
     * @param \App\Hotelbook\Object\Hotel\SearchParameter|null $parameter
     * @return \App\Hotelbook\Object\SearchResult
     */
    public function search($value, Carbon $checkInDate, Carbon $checkOutDate, array $rooms, SearchParameter $parameter = null)
    {
        return $this->callMethod('search', [
            $value, $checkInDate, $checkOutDate,
            $rooms, $parameter
        ]);
    }

    /**
     * $value - это ID отеля, пока $byName = false
     * $value - это имя отеля, пока $byName = true
     *
     * @param $value
     * @param bool $byName
     * @return mixed
     */
    public function detail($value, bool $byName = false)
    {
        return $this->callMethod('detail', [$value, $byName]);
    }

    /**
     * @param \App\Hotelbook\Object\Contact $contact
     * @param BookItem[] $items
     * @param Tag $tag
     * @param $searchResult = null
     * @return mixed
     */
    public function book(Contact $contact, array $items, Tag $tag, $searchResult = null)
    {
        return $this->callMethod('book', [$contact, $items, $tag, $searchResult]);
    }

    /**
     * Метод для аннулирования заказа
     * @param int $orderId
     * @param int $itemId
     * @return mixed
     */
    public function annulOrder(int $orderId, int $itemId)
    {
        return $this->callMethod('annulOrder', [$orderId, $itemId]);
    }

    /**
     * Метод для отмены заказа (если заказ был уже подтвержден)
     * @param int $orderId
     * @param int $itemId
     * @return mixed
     */
    public function cancelOrder(int $orderId, int $itemId)
    {
        return $this->callMethod('cancelOrder', [$orderId, $itemId]);
    }

    /**
     *
     * @param int $orderId
     * @param int $itemId
     * @param string $price
     * @param string $currency
     * @return mixed
     */
    public function confirmOrder(int $orderId, int $itemId, string $price, string $currency)
    {
        return $this->callMethod('confirmOrder', [
            $orderId, $itemId, $price, $currency
        ]);
    }
}
