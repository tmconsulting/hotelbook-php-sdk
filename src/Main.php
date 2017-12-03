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
use App\Hotelbook\Method\Dynamic\AnnulOrder;
use App\Hotelbook\Method\Dynamic\AsyncSearch;
use App\Hotelbook\Method\Dynamic\Book;
use App\Hotelbook\Method\Dynamic\CancelOrder;
use App\Hotelbook\Method\Dynamic\ConfirmOrder;
use App\Hotelbook\Method\Dynamic\Detail;
use App\Hotelbook\Method\Dynamic\Search;
use App\Hotelbook\Method\DynamicResolver;
use App\Hotelbook\Object\Contact;
use App\Hotelbook\Object\Hotel\BookItem;
use App\Hotelbook\Object\Hotel\SearchParameter;
use App\Hotelbook\Object\Hotel\Tag;
use Carbon\Carbon;
use App\Hotelbook\Object\Method\Search\AsyncSearchParams;
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
    use DynamicResolver;

    /**
     * A private variable where the dictionary resolver class is stored
     * @var DictionaryInterface
     */
    private $dictionary;

    /**
     * Main constructor.
     */
    public function __construct($config)
    {
        $connector = $this->makeConnector($config);

        $this->setMethods($connector);
        $this->setDictionary(new Dictionary($connector));
    }

    /**
     * A method to fetch the dictionary object.
     * @return DictionaryInterface
     */
    public function getDictionary()
    {
        return $this->dictionary;
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
    ) {
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
     * @param DictionaryInterface $dictionary
     * return void
     */
    private function setDictionary(DictionaryInterface $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Validate and create the connector instance.
     * @param $config
     * @throws UndefinedOptionsException
     * @return Connector
     */
    protected function makeConnector($config)
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'url' => 'http://test1.hotelbook.pro/xml/',
            'differencePath' => sys_get_temp_dir(),
            'auth' => []
        ])->setRequired(['url', 'auth'])
            ->setAllowedTypes('url', 'string')
            ->setAllowedTypes('differencePath', 'string')
            ->setAllowedTypes('auth', 'array');

        $authResolver = new OptionsResolver();

        $authResolver->setDefaults([
            'login' => 'login',
            'password' => 'password'
        ])->setRequired(['login', 'password'])
            ->setAllowedTypes('login', 'string')
            ->setAllowedTypes('password', 'string');

        $config = $resolver->resolve($config);
        $config['auth'] = $authResolver->resolve($config['auth']);

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
     * @param $connector
     */
    private function setMethods($connector)
    {
        $this->setMethod('search', new Search($connector));
        $this->setMethod('asyncSearch', new AsyncSearch($connector));
        $this->setMethod('detail', new Detail($connector));
        $this->setMethod('book', new Book($connector));
        $this->setMethod('annulOrder', new AnnulOrder($connector));
        $this->setMethod('cancelOrder', new CancelOrder($connector));
        $this->setMethod('confirmOrder', new ConfirmOrder($connector));
    }
}
