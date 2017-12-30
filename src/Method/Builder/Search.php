<?php

declare(strict_types=1);

namespace Hotelbook\Method\Builder;

use Carbon\Carbon;
use Hotelbook\Object\Hotel\SearchParameter;
use Hotelbook\Object\Hotel\SearchPassenger;
use SimpleXMLElement;

/**
 * Class Search
 * @package App\Hotelbook\Method\Builder\Dynamic
 */
class Search implements BuilderInterface
{
    /**
     * Default Date-format
     */
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        /** @var Carbon $checkInDate */
        /** @var SearchPassenger[] $rooms */
        /** @var SearchParameter $searchParameter */
        [$value, $checkInDate, $checkOutDate, $rooms, $searchParameter] = $params;

        $xml = new SimpleXMLElement('<HotelSearchRequest/>');
        $request = $xml->addChild('Request');
        $request->addAttribute('cityId', (string)$value);

        if ($searchParameter->getHotelName() !== null) {
            $request->addAttribute('hotelName', $searchParameter->getHotelName());
        }

        $request->addAttribute('checkIn', $checkInDate->format(self::DATE_FORMAT));
        $request->addAttribute('duration', (string)$checkInDate->diffInDays($checkOutDate));
        $request->addAttribute('confirmation', 'online');
        $request->addAttribute('limitResults', '100');

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
}
