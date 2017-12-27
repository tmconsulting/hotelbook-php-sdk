<?php

namespace App\Hotelbook;

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
interface HotelInterface
{
    /**
     * A method for hotel search.
     * @param int $cityId
     * @param Carbon $checkInDate
     * @param Carbon $checkOutDate
     * @param array $rooms
     * @param SearchParameter $searchParameter
     * @return mixed
     */
    public function search(int $cityId, Carbon $checkInDate, Carbon $checkOutDate, array $rooms, SearchParameter $searchParameter);

    /**
     * A method to fetch details of a hotel form search.
     * $value - it's ID of hotel, when $byName = false
     * $value - it's NAME of hotel, when $byName = true
     * @param $value
     * @param bool $byName
     * @return mixed
     */
    public function detail($value, bool $byName = false);

    /**
     * A method to book a hotel (By Search)
     * @param \App\Hotelbook\Object\Contact $contact
     * @param BookItem[] $items
     * @param Tag $tag
     * @param $searchResult = null
     * @return mixed
     */
    public function book(Contact $contact, array $items, Tag $tag, $searchResult = null);

    /**
     * Method to cancel the order (before confirm)
     * @param int $orderId
     * @param int $itemId
     * @return mixed
     */
    public function cancelOrder(int $orderId, int $itemId);

    /**
     * Method to confirm the order
     * @param int $orderId
     * @param int $itemId
     * @param string $price
     * @param string $currency
     * @return mixed
     */
    public function confirmOrder(int $orderId, int $itemId, string $price, string $currency);

    /**
     * Method to cancel the order (after confirm)
     * @param int $orderId
     * @param int $itemId
     * @return mixed
     */
    public function annulOrder(int $orderId, int $itemId);

    /**
     * Fetch all available countries.
     * @return mixed
     */
    public function country();

    /**
     * Fetch all available cities.
     * @param int|null $cityId
     * @return mixed
     */
    public function city($cityId = null);

    /**
     * Fetch all available locations.
     * @return mixed
     */
    public function location();

    /**
     * Fetch all available hotel types.
     * @return mixed
     */
    public function hotelType();

    /**
     * Fetch all available meal types.
     * @return mixed
     */
    public function meal();

    /**
     * Fetch all available room sizes.
     * @return mixed
     */
    public function roomSize();

    /**
     * Fetch all available room types.
     * @return mixed
     */
    public function roomType();

    /**
     * Fetch all available room amenities.
     * @return mixed
     */
    public function roomAmenity();
}
