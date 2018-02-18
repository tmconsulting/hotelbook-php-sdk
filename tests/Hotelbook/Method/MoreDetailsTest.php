<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use Carbon\Carbon;
use Hotelbook\Method\Search;
use Hotelbook\Object\Hotel\SearchParameter;
use Hotelbook\Object\Hotel\SearchPassenger;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use Hotelbook\Method\MoreDetails;


class MoreDetailsTest extends TestCase
{
    public function testHowMoreDetailsMethodBuildTheSimpleRequest()
    {
        $moreDetails = new MoreDetails(new ConnectorStub);

        $xml = $moreDetails->build([1, 2]);

        $this->assertEquals($this->getRequestProtocol('more-details'), $xml);
    }

    public function testsHowMoreDetailsMethodHandleTheRequest()
    {
        $moreDetails = new MoreDetails(new ConnectorStub('hotel-search-details'));
        $results = $moreDetails->handle($this->getRequestProtocol('more-details'));

        $this->assertInstanceOf(ResultProceeder::class, $results);
        $this->assertNotEmpty($results->getItem());
    }
}
