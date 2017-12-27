<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/23/17
 */

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\Search;
use App\Hotelbook\Object\Hotel\SearchParameter;
use App\Hotelbook\Object\Hotel\SearchPassenger;
use App\Hotelbook\ResultProceeder;
use Carbon\Carbon;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class SearchTest extends TestCase
{
    public function testHowSearchMethodBuildTheSimpleRequest()
    {
        $search = new Search(new ConnectorStub);

        $checkInDate  = Carbon::parse('03-11-2017');
        $checkOutDate = Carbon::parse('10-11-2017');

        $xml = $this->formatXml($search->build([2, $checkInDate, $checkOutDate, [
            new SearchPassenger(1, [12])
        ], new SearchParameter()]));

        $this->assertEquals($this->getRequestProtocol('search-simple'), $xml);
    }

    public function testsHowSearchMethodHandleTheRequest()
    {
        $search  = new Search(new ConnectorStub('search'));
        $results = $search->handle($this->getRequestProtocol('search-simple'));

        $this->assertInstanceOf(ResultProceeder::class, $results);
        $this->assertNotEmpty($results->getItems());
    }
}
