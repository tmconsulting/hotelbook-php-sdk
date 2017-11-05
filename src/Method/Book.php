<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider_hotelbook
 */

declare(strict_types=1);

namespace App\Hotelbook\Method;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Object\Contact;
use App\Hotelbook\Object\Hotel\BookItem;
use App\Hotelbook\Object\Hotel\BookPassenger;
use Money\Parser\StringToUnitsParser;
use App\Hotelbook\Object\Results\BookResult;

class Book extends AbstractMethod
{
    /**
     * @var \App\Hotelbook\Connector\ConnectorInterface
     */
    private $connector;

    /**
     * SearchResult constructor.
     *
     * @param \App\Hotelbook\Connector\ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    protected function getRandomTag()
    {
        return (string)random_int(10000, 99999);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        /** @var Contact $contact */
        /** @var BookItem[] $items */
        [$contact, $items] = $params;

        $xml = new \SimpleXMLElement('<AddOrderRequest/>');

        $contactXml = $xml->addChild('ContactInfo');
        $contactXml->addChild('Name', $contact->getName());
        $contactXml->addChild('Email', $contact->getEmail());
        $contactXml->addChild('Phone', $contact->getPhone());
        $contactXml->addChild('Comment', $contact->getComment());

        $xml->addChild('Tag', $this->getRandomTag());

        $hotelItems = $xml->addChild('Items');

        foreach ($items as $item) {
            $hotel = $hotelItems->addChild('HotelItem');
            $search = $hotel->addChild('Search');
            $search->addAttribute('searchId', $item->getSearchId());
            $search->addAttribute('resultId', $item->getResultId());
            $hotel->addChild('PayForm', 'cashless'); // оплата безналом по умолчанию
            $roomsXml = $hotel->addChild('Rooms');
            foreach ($this->paxHandling($item) as $room) {
                $roomXml = $roomsXml->addChild('Room');
                /** @var BookPassenger $person */
                foreach ($room as $person) {
                    $pax = $roomXml->addChild('RoomPax');
                    $pax->addChild('Title', $person->getTitle());
                    $pax->addChild('FirstName', $person->getFirstName());
                    $pax->addChild('LastName', $person->getLastName());

                    if ($person->isChild()) {
                        $pax->addAttribute('child', 'true');
                        $pax->addAttribute('age', $person->getAge());
                    }
                }
            }
        }

        return $xml->asXML();
    }

    /**
     * Обработка паксов. Дробит взрослых и детей на две части,
     * добавляет TBA для не указанных человек (на основе поиска)
     * и затем детей кидает в конец списка.
     *
     * @link http://xmldoc.hotelbook.ru/ru/hotels/add-order.html#roompax
     * @param \App\Hotelbook\Object\Hotel\BookItem $bookItem
     * @return \App\Hotelbook\Method\Collection
     */
    protected function paxHandling(BookItem $bookItem)
    {
        $childs = [];
        $adults = [];
        foreach ($bookItem->getRooms() as $index => $room) {
            foreach ($room as $person) {
                if ($person->isChild()) {
                    $childs[$index][] = $person;
                } else {
                    $adults[$index][] = $person;
                }
            }
        }

        return collect($this->putChildrenToBottom($adults, $childs));
    }

    /**
     * Хотелбук требует указывать детей последними в списке.
     *
     * Выжимка: true – если это ребёнок (в этом случае элемент
     * RoomPax должен быть последним в элементе Room)
     *
     * @link http://xmldoc.hotelbook.ru/ru/hotels/add-order.html#roompax
     * @param array $adults
     * @param array $childs
     * @return array
     */
    protected function putChildrenToBottom(array $adults, array $childs)
    {
        $results = [];
        foreach ($adults as $roomIndex => $human) {
            if (isset($childs[$roomIndex])) {
                $results[$roomIndex] = array_merge($human, $childs[$roomIndex]);
            } else {
                $results[$roomIndex] = $human;
            }
        }

        return $results;
    }

    /**
     * Метод для выполнения самого запроса
     * @param $xml <- builds results
     * @return mixed
     */
    public function handle($xml)
    {
        $response = $this->connector->request('POST', 'add_order', $xml);
        // file_put_contents('book-response.xml', $response->asXML());

        $errors = $this->getErrors($response);
        $values = [];

        if (emptyArray($errors)) {
            $values = $this->form($response);
        }

        return new BookResult($values, $errors);
    }

    /**
     * Метод для формирования ответа из ответа XML //TODO сделать такой во всех методах
     * @param $response
     * @return array
     */
    public function form($response)
    {
        $orderId = (int) $response->OrderId;
        $items = [];

        foreach ($response->Items->ItemId as $item) {
            $itemId = (int)($item);
            $item = current($item);

            $money = $this->money($item['TotalPrice'], $item['Currency']);
            $items[] = [
                'itemId' => $itemId,
                'price' => [
                    'sum' => $money->getAmount(),
                    'currency' => $money->getCurrency(),
                ]
            ];
        }

        return [
            'orderId' => $orderId,
            'items' => $items
        ];
    }
}
