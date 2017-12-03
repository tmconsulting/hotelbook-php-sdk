<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider_hotelbook
 */

declare(strict_types=1);

namespace App\Hotelbook\Method\Dynamic;

use App\Hotelbook\Connector\ConnectorInterface;
use App\Hotelbook\Method\AbstractMethod;
use App\Hotelbook\Method\Builder\Dynamic\Book as BookBuilder;
use App\Hotelbook\Method\Former\Dynamic\Book as BookFormer;
use App\Hotelbook\Results\Method\BookResult;
use Money\Parser\StringToUnitsParser;

/**
 * A method to book a hotel (After search)
 * Class Book
 * @package App\Hotelbook\Method\Dynamic
 */
class Book extends AbstractMethod
{
    /**
     * @var BookBuilder
     */
    protected $builder;
    /**
     * @var BookFormer
     */
    protected $former;

    /**
     * Book constructor.
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        parent::__construct($connector);

        $this->builder = new BookBuilder();
        $this->former = new BookFormer();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function build($params)
    {
        return $this->builder->build($params);
    }

    /**
     * Method to actually query the request
     * @param $xml <- builds results
     * @return mixed
     */
    public function handle($xml)
    {
        $response = $this->connector->request('POST', 'add_order', $xml);
        return $this->getResultObject($response);
    }

    /**
     * Method to form result out of XML
     * @param $response
     * @return array
     */
    protected function form($response)
    {
        return $this->former->form($response);
    }


    /**
     * @return string
     */
    protected function getResultClass()
    {
        return BookResult::class;
    }
}
