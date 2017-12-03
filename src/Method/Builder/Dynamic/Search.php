<?php

declare(strict_types=1);

namespace App\Hotelbook\Method\Builder\Dynamic;

use App\Hotelbook\Object\Hotel\SearchPassenger;
use Carbon\Carbon;
use SimpleXMLElement;
use App\Hotelbook\Method\Builder\BuilderInterface;

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
        [$value, $checkInDate, $checkOutDate, $rooms] = $params;

        $xml = new SimpleXMLElement('<HotelSearchRequest/>');
        $request = $xml->addChild('Request');
        $request->addAttribute('cityId', (string)$value);

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
