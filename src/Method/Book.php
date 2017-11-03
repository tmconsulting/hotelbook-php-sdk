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

final class Book implements MethodInterface
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

        $xml->addChild('Tag', (string)random_int(10000, 99999));

        $hotelItems = $xml->addChild('Items');

        foreach ($items as $item) {
            $hotel = $hotelItems->addChild('HotelItem');
            $search = $hotel->addChild('SearchResult');
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

        header('Content-Type: text/xml');
        echo $xml->asXML();
        exit;

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

        // $adults = $this->tbaAutoComplete($payload, $adults);
        // $childs = $this->tbaAutoComplete($payload, $childs, true);

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
     * Дополняет массив TBA-персонами (не указанные личности в заказе.)
     * Означает заполнение бумажек на месте.
     *
     * @param $payload
     * @param array $pax
     * @param bool $child
     * @return array
     */
//    protected function tbaAutoComplete($payload, array $pax, $child = false)
//    {
//        $name  = $child ? 'TBA_CHILD_' : 'TBA_ADULT_';
//        $title = $child ? Title::CHILD : Title::MR;
//        $key   = $child ? 'childs'     : 'adults';
//
//        $results = [];
//        foreach ($payload['request']['rooms'] as $group => $room) {
//            $count = 0;
//            if (isset($pax[$group])) {
//                $count = count($pax[$group]);
//                $results[$group] = $pax[$group];
//            }
//
//            for($i = $count; $i < $room[$key]; $i++) {
//                $results[$group][$i] = [
//                    'title'     => $title,
//                    'firstName' => $name . $i,
//                    'lastName'  => $name . $i,
//                    'group'     => $group
//                ];
//            }
//        }
//
//        return $results;
//    }

    /**
     * @param $xml <- builds results
     * @return mixed
     */
    public function handle($xml)
    {
        $results = $this->connector->request('POST', 'add_order', $xml);

        file_put_contents('booking.xml', $results->asXML());

        dd($results);
    }
}