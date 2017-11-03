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
use App\Hotelbook\Object\Hotel\SearchPassenger;
use App\Hotelbook\Object\SearchResult;
use Carbon\Carbon;
use Money\Currencies\ISOCurrencies;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use Money\Parser\StringToUnitsParser;
use SimpleXMLElement;

final class Search extends AbstractMethod
{
    const DATE_FORMAT = 'Y-m-d';
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
        /** @var Carbon $checkInDate */
        /** @var SearchPassenger[] $rooms */
        [$value, $checkInDate, $checkOutDate, $rooms,] = $params;

        $xml = new SimpleXMLElement('<HotelSearchRequest/>');
        $request = $xml->addChild('Request');
        $request->addAttribute('cityId', (string)$value);

//        if ( ! empty($hotelId = $option->getHotelId())) {
//            $request->addAttribute('hotelId', strval($hotelId));
//        }

        $request->addAttribute('checkIn', $checkInDate->format(self::DATE_FORMAT));
        $request->addAttribute('duration', (string)$checkInDate->diffInDays($checkOutDate));
        $request->addAttribute('confirmation', 'online');

//        if ( ! empty($providerId = $option->getProviderId())) {
//            $providers = $request->addChild('Providers');
//            $providers->addChild('Provider', strval($providerId));
//        }

        $roomsXml = $xml->addChild('Rooms');

        $i = 0;
        foreach ($rooms as $room) {
            $roomXmlChild = $roomsXml->addChild('Room');
            $roomXmlChild->addAttribute('roomNumber', (string)++$i);
            $roomXmlChild->addAttribute('adults', (string)$room->getAdults());

            if ($room->getCountOfChildrens() > 0) {
                $roomXmlChild->addAttribute('children', (string)$room->getCountOfChildrens());
                foreach ($room->getChildrens() as $age) {
                    $roomXmlChild->addChild('ChildAge', (string)$age);
                }
            }
        }

        return $xml->asXML();
    }

    /**
     * @param $results <- builds results
     * @return mixed
     */
    public function handle($results)
    {
        $response = $this->connector->request('POST', 'hotel_search', $results);
        $search = current($response->HotelSearch);
        file_put_contents('search-london.xml', $response->asXML());

        $i = 0;
        $array = [];
        foreach ($response->Hotels->Hotel as $hotel) {
            if (!isset($hotel->Rooms->Room)) {
                continue;
            }

            $value = current($hotel);
            $money = $this->money($value['price'], $value['currency']);

            $array[$i] = [
                'searchId' => (string)$search['searchId'],
                'resultId' => (string)$value['resultId'],
                'hotelId' => (int)$value['hotelId'],
                'name' => (string)$value['hotelName'],
                'subProviderId' => (int)$value['providerId'],
                'address' => (string)$value['hotelAddress'],
                'stars' => (int)$value['hotelCatName'],
                'image' => (string)$value['hotelPhotoUrl'],
                'coords' => [
                    'lat' => isset($value['hotelLatitude']) ? (float)$value['hotelLatitude'] : null,
                    'lng' => isset($value['hotelLongitude']) ? (float)$value['hotelLongitude'] : null,
                ],
                'price' => [
                    'sum' => $money->getAmount(),
                    'currency' => $money->getCurrency(),
                    //@link: http://xmldoc.hotelbook.ru/ru/hotels/hotel-search.html?highlight=useNds
                    'vat' => to_bool(array_get($value, 'useNds')),
                    'noOpenSale' => !to_bool(array_get($value, 'noOpenSale')),
                    'quotaAmount' => $this->money((string)array_get($value, 'quotaAmount'), $value['currency'])->getAmount(),
                    'rackRate' => $this->money((string)array_get($value, 'priceRackRate'), $value['currency'])->getAmount(),
                ],
            ];

            $childAge = null;
            if (isset($hotel->Rooms->Room->ChildAge)) {

            }

            foreach ($hotel->Rooms->Room as $room) {
                $room = current($room);
                $array[$i]['rooms'][] = [
                    'number' => (int)$room['roomNumber'],
                    'sizeId' => (int)$room['roomSizeId'],
                    'sizeName' => (string)$room['roomSizeName'],
                    // 'sizeDescription' => (string) $room['roomSizeDescription'],
                    'typeId' => (int)$room['roomTypeId'],
                    'typeName' => (string)$room['roomTypeName'],
                    //'typeDescription' => (string) $room['roomTypeDescription'],
                    'viewId' => (int)$room['roomViewId'],
                    'viewName' => (string)$room['roomViewName'],
                    'mealId' => (int)$room['mealId'],
                    'cots' => (int)$room['cots'],
                    'children' => (int)$room['children'],
                    // 'viewDescription' => (string) $room['roomViewDescription'],
                ];
            }

            $i++;
        }

        return new SearchResult($array, $this->getErrors($response));
    }

    /**
     * @param $sum
     * @param $currency
     * @return Money
     */
    private function money($sum, $currency)
    {
        $currencies = new ISOCurrencies();
        $parser = new DecimalMoneyParser($currencies);

        return $parser->parse($sum, $currency);
    }
}