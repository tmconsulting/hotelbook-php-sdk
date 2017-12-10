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

use App\Hotelbook\Method\Builder\Book as BookBuilder;
use App\Hotelbook\Method\Former\Book as BookFormer;
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
        file_put_contents('book.xml', $response->asXML());
        return $this->getResultObject($response);
    }

    protected function getBuilderClass()
    {
        return BookBuilder::class;
    }

    protected function getFormerClass()
    {
        return BookFormer::class;
    }
}
