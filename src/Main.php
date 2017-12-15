<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/17/17
 */

namespace App\Hotelbook;

use App\Hotelbook\Connector\Connector;
use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AnnulOrder;
use App\Hotelbook\Method\AsyncSearch;
use App\Hotelbook\Method\Book;
use App\Hotelbook\Method\CancelOrder;
use App\Hotelbook\Method\City;
use App\Hotelbook\Method\ConfirmOrder;
use App\Hotelbook\Method\Country;
use App\Hotelbook\Method\CurrencyRate;
use App\Hotelbook\Method\Detail;
use App\Hotelbook\Method\DynamicResolver;
use App\Hotelbook\Method\HotelCategory;
use App\Hotelbook\Method\HotelFacility;
use App\Hotelbook\Method\HotelList;
use App\Hotelbook\Method\HotelType;
use App\Hotelbook\Method\Location;
use App\Hotelbook\Method\Meal;
use App\Hotelbook\Method\MealBreakfast;
use App\Hotelbook\Method\Resort;
use App\Hotelbook\Method\RoomAmenity;
use App\Hotelbook\Method\RoomSize;
use App\Hotelbook\Method\RoomType;
use App\Hotelbook\Method\RoomView;
use App\Hotelbook\Method\Search;
use App\Hotelbook\Object\Contact;
use App\Hotelbook\Object\Hotel\BookItem;
use App\Hotelbook\Object\Hotel\SearchParameter;
use App\Hotelbook\Object\Hotel\Tag;
use App\Hotelbook\Object\Method\Search\AsyncSearchParams;
use Carbon\Carbon;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Main
 *
 * @package App\Hotelbook
 */
class Main implements HotelInterface
{
    /**
     * Use the dynamic resolver trait.
     */
    use Resolver;

    /**
     * @var ConnectorInterface
     */
    protected $connector;

    /**
     * Main constructor.
     */
    public function __construct($config)
    {
        $this->connector = $this->makeConnector($config);

        $this->setMethods();
        $this->setDictionaryMethods();
    }

    /**
     * A method for hotel search.
     * @param int $cityId
     * @param Carbon $checkInDate
     * @param Carbon $checkOutDate
     * @param array $rooms
     * @param SearchParameter|null $parameter
     * @return mixed
     */
    public function search(int $cityId, Carbon $checkInDate, Carbon $checkOutDate, array $rooms, SearchParameter $parameter = null)
    {
        return $this->callMethod('search', [
            $cityId, $checkInDate, $checkOutDate,
            $rooms, $parameter
        ]);
    }

    /**
     * Method for async search.
     * $cityId - the id of city
     * $checkInDate - the check in date
     * $checkOutDate - the check out date
     * $passengers - passengers
     * $parameter - object of params
     *
     * @param $value
     * @param \Carbon\Carbon $checkInDate
     * @param \Carbon\Carbon $checkOutDate
     * @param \App\Hotelbook\Object\Hotel\SearchPassenger[] $rooms
     * @param AsyncSearchParams $searchParams
     * @return \App\Hotelbook\Object\SearchResult
     */
    public function asyncSearch(
        $value,
        Carbon $checkInDate,
        Carbon $checkOutDate,
        array $rooms,
        AsyncSearchParams $searchParams
    )
    {
        return $this->callMethod('asyncSearch', [
            [$value, $checkInDate, $checkOutDate, $rooms],
            $searchParams
        ]);
    }

    /**
     * A method to fetch details of a hotel form search.
     * $value - it's ID of hotel, when $byName = false
     * $value - it's NAME of hotel, when $byName = true
     * @param $value
     * @param bool $byName
     * @return mixed
     */
    public function detail($value, bool $byName = false)
    {
        return $this->callMethod('detail', [$value, $byName]);
    }

    /**
     * A method to book a hotel (By Search)
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
     * Method to cancel the order (before confirm)
     * @param int $orderId
     * @param int $itemId
     * @return mixed
     */
    public function cancelOrder(int $orderId, int $itemId)
    {
        return $this->callMethod('cancelOrder', [$orderId, $itemId]);
    }

    /**
     * Method to confirm the order
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

    /**
     * Method to cancel the order (after confirm)
     * @param int $orderId
     * @param int $itemId
     * @return mixed
     */
    public function annulOrder(int $orderId, int $itemId)
    {
        return $this->callMethod('annulOrder', [$orderId, $itemId]);
    }

    /**
     * Fetch all available countries.
     * @return mixed
     */
    public function country()
    {
        return $this->callMethod('country');
    }

    /**
     * Fetch all available cities.
     * @param int|null $countryId
     * @return mixed
     */
    public function city($countryId = null)
    {
        return $this->callMethod('city', [$countryId]);
    }

    /**
     * Fetch all available locations.
     * @return mixed
     */
    public function location()
    {
        return $this->callMethod('location');
    }

    /**
     * Fetch all available resorts.
     * @param null $countryId
     * @return mixed
     */
    public function resort($countryId = null)
    {
        return $this->callMethod('resort', [$countryId]);
    }

    /**
     * Fetch all available hotel types.
     * @return mixed
     */
    public function hotelType()
    {
        return $this->callMethod('hotelType');
    }

    /**
     * Fetch all available hotel categories.
     * @return mixed
     */
    public function hotelCategory()
    {
        return $this->callMethod('hotelCategory');
    }

    /**
     * Fetch all available hotel facilities.
     * @return mixed
     */
    public function hotelFacility()
    {
        return $this->callMethod('hotelFacility');
    }

    /**
     * Fetch all available hotels in city / country.
     * @param int|null $cityId
     * @param int|null $countryId
     * @return mixed
     */
    public function hotelList(int $cityId = null, int $countryId = null)
    {
        return $this->callMethod('hotelList', [
            $cityId, $countryId
        ]);
    }

    /**
     * Fetch all available meal types.
     * @return mixed
     */
    public function meal()
    {
        return $this->callMethod('meal');
    }

    /**
     * Fetch all available meal types.
     * @return mixed
     */
    public function mealBreakfast()
    {
        return $this->callMethod('mealBreakfast');
    }

    /**
     * Fetch all available room sizes.
     * @return mixed
     */
    public function roomSize()
    {
        return $this->callMethod('roomSize');
    }

    /**
     * Fetch all available room types.
     * @return mixed
     */
    public function roomType()
    {
        return $this->callMethod('roomType');
    }

    /**
     * Fetch all available room amenities.
     * @return mixed
     */
    public function roomAmenity()
    {
        return $this->callMethod('roomAmenity');
    }

    /**
     * Fetch all available room views.
     * @return mixed
     */
    public function roomView()
    {
        return $this->callMethod('roomView');
    }

    /**
     * Fetch all currency rates.
     * @return mixed
     */
    public function currencyRate()
    {
        return $this->callMethod('currencyRate');
    }

    /**
     * Validate and create the connector instance.
     * @param $config
     * @throws UndefinedOptionsException
     * @throws AccessException
     * @return Connector
     */
    protected function makeConnector($config)
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'url' => 'http://test1.hotelbook.pro/xml/',
            'differencePath' => sys_get_temp_dir(),
            'login' => 'login',
            'password' => 'password'
        ])->setRequired(['url', 'login', 'password'])
            ->setAllowedTypes('url', 'string')
            ->setAllowedTypes('differencePath', 'string')
            ->setAllowedTypes('login', 'string')
            ->setAllowedTypes('password', 'string');

        $config = $resolver->resolve($config);

        return $this->createConnector($config);
    }

    /**
     * Method that creates the connector instance.
     * @param $config
     * @return ConnectorInterface
     */
    protected function createConnector($config)
    {
        return new Connector($config);
    }

    /**
     * Method to set all the methods into dynamic resolver.
     * @return void
     */
    private function setMethods()
    {
        $this->setMethod('search', Search::class);
        $this->setMethod('asyncSearch', AsyncSearch::class);
        $this->setMethod('detail', Detail::class);
        $this->setMethod('book', Book::class);
        $this->setMethod('annulOrder', AnnulOrder::class);
        $this->setMethod('cancelOrder', CancelOrder::class);
        $this->setMethod('confirmOrder', ConfirmOrder::class);
    }

    /**
     * Private method to set the dictionary methods
     * @return void
     */
    private function setDictionaryMethods()
    {
        //Locations
        $this->setMethod('country', Country::class);
        $this->setMethod('city', City::class);
        $this->setMethod('location', Location::class);
        $this->setMethod('resort', Resort::class);

        //Hotel
        $this->setMethod('hotelType', HotelType::class);
        $this->setMethod('hotelCategory', HotelCategory::class);
        $this->setMethod('hotelFacility', HotelFacility::class);
        $this->setMethod('hotelList', HotelList::class);
        $this->setMethod('meal', Meal::class);
        $this->setMethod('mealBreakfast', MealBreakfast::class);

        //Rooms
        $this->setMethod('roomSize', RoomSize::class);
        $this->setMethod('roomType', RoomType::class);
        $this->setMethod('roomAmenity', RoomAmenity::class);
        $this->setMethod('roomView', RoomView::class);

        //Misc
        $this->setMethod('currencyRate', CurrencyRate::class);
    }

}
