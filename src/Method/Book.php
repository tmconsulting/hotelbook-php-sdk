<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider_hotelbook
 */

declare(strict_types=1);

namespace Hotelbook\Method;

use Hotelbook\Method\Builder\Book as BookBuilder;
use Hotelbook\Method\Former\Book as BookFormer;
use Hotelbook\ResultProceeder;
use Money\Parser\StringToUnitsParser;

/**
 * A method to book a hotel (After search)
 * Class Book
 * @package App\Hotelbook\Method\Dynamic
 */
class Book extends AbstractMethod
{
    /**
     * Method to actually query the request
     * @param $xml <- builds results
     * @return mixed
     */
    public function handle($xml)
    {
        $response = $this->connector->request('POST', 'add_order', $xml);
        return $this->getResultObject($response, null, ResultProceeder::class, false);
    }

    /**
     * @return string
     */
    protected function getBuilderClass()
    {
        return BookBuilder::class;
    }

    /**
     * @return string
     */
    protected function getFormerClass()
    {
        return BookFormer::class;
    }
}
